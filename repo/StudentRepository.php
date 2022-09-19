<?php

namespace kncity\repo;

use kncity\app\DB;
use kncity\app\User;

/**
 * @param DB $db
 */
class StudentRepository
{

    private $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function getList(int $offset, int $count): array
    {
        return $this->db->query("SELECT * FROM students ORDER BY id LIMIT ?,?", "ii", [$offset, $count]);
    }

    public function getCount(): int
    {
        $r = $this->db->query("SELECT COUNT(*) as c FROM students;", "", []);
        return (int)$r[0]["c"];
    }
}