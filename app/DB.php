<?php

namespace kncity\app;

use mysqli;

/**
 * @param mysqli $connect
 */
class DB
{
    /**
     * @var mysqli
     */
    private $connect;

    public function __construct(
        ?string $hostname = null,
        ?string $username = null,
        ?string $password = null,
        ?string $database = null
    )
    {
        $this->connect = new mysqli($hostname, $username, $password);
        $this->connect->set_charset("utf-8");
        $this->connect->select_db($database);
        $this->connect->query("SET CHARACTER SET UTF8;");
    }

    public function query(
        string $q,
        string $types,
        array  $args
    ): array
    {
        $stmt = $this->connect->prepare($q);
        if ($types) {
            if (!$stmt->bind_param($types, ...$args)) {
                throw new \Exception(json_encode($args));
            }
        }
        if (!$stmt->execute()) {
            throw new \Exception($stmt->error);
        }


        $r = $stmt->get_result();
        return $r ? $r->fetch_all(MYSQLI_ASSOC) : [];
    }
}