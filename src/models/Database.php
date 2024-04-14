<?php

declare(strict_types=1);

namespace Model;

require_once "../../config/config.php";

class Database
{
    protected function connect()
    {
        try {
            $conn = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
    }
}
