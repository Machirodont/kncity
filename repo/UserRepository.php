<?php

namespace kncity\repo;

use kncity\app\DB;
use kncity\app\User;

/**
 * @param DB $db
 */
class UserRepository
{

    private $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function findByUsername(string $username): ?User
    {
        $r = $this->db->query("SELECT id, password_hash FROM api_users WHERE username=?", "s", [$username]);

        if (!count($r)) {
            return null;
        }

        $user = new User();
        $user->id = (int)$r[0]['id'];
        $user->username = $username;
        $user->password_hash = $r[0]['password_hash'];
        return $user;
    }

    public function findByAuthToken(string $token): ?User
    {
        $r = $this->db->query("
SELECT user_id, username, password_hash 
FROM user_sessions
LEFT JOIN api_users au on user_sessions.user_id = au.id
WHERE auth_token=?
AND logout IS NULL
", "s", [$token]);

        if (!count($r)) {
            return null;
        }

        $user = new User();
        $user->id = (int)$r[0]['user_id'];
        $user->username = $r[0]['username'];
        $user->password_hash = $r[0]['password_hash'];
        return $user;
    }

    public function registerToken(int $userId, string $authToken)
    {
        $this->db->query(
            "INSERT INTO user_sessions(user_id, auth_token) VALUES (?,?);",
            "is",
            [$userId, $authToken]
        );
    }

    public function invalidateToken(string $authToken)
    {
        $this->db->query(
            "UPDATE user_sessions SET logout=? WHERE auth_token=?;",
            "ss",
            [date("Y-m-d H:i:s"), $authToken]
        );
    }
}