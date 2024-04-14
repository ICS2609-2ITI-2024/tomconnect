<?php

declare(strict_types=1);

namespace Tomconnect\Models;

require_once dirname(dirname(__DIR__)) . "\\config\\config.php";

use PDO;
use PDOException;

class Database
{
    protected function connect()
    {
        try {
            $dbh = new PDO("mysql:host=" . DB_HOST . ";port= " . DB_PORT . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbh;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
