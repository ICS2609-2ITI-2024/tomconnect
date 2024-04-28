<?php

declare(strict_types=1);

namespace Tomconnect\Models;

use PDO;
use Exception;
use Tomconnect\Models\Model;

class UserModel extends Model
{
    const CREATE_SQL_STATEMENT = "INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash);";
    
    const FETCH_ALL_SQL_STATEMENT = "SELECT * FROM users WHERE is_deleted = 0;";

    const FETCH_SQL_STATEMENT = "SELECT * FROM users WHERE is_deleted = 0 AND user_id = :user_id;";
    
    const FIND_SQL_STATEMENT_PREFIX = "SELECT * FROM users WHERE is_deleted = 0 AND";

    const DELETE_SQL_STATEMENT = "UPDATE users SET is_deleted = 1 WHERE user_id = :user_id;";

    const GET_ID_SQL_STATEMENT = "SELECT user_id FROM users where username = :username AND email = :email;";
    // CREATE
    public static function create(array $data)
    {
        try {
            $stmt = parent::connect()->prepare(self::CREATE_SQL_STATEMENT);
            $stmt->execute(parent::map_array_with_exec_prefix($data));
            return true;
        } catch (Exception $e) {
            echo "USER CREATION FAILED: " . $e;
            return false;
        }
    }
    // READ

    public static function fetch_all()
    {
        try {
            $stmt = parent::connect()->prepare(self::FETCH_ALL_SQL_STATEMENT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "FETCHING FAILED: " . $e;
        }
    }
    
    public static function fetch($user_id)
    {
        try {
            $stmt = parent::connect()->prepare(self::FETCH_SQL_STATEMENT);
            $stmt->bindParam(":user_id", $identifier);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "FETCHING FAILED: " . $e;
        }
    }

    public static function find(string $column, string $value)
    {
        $sql = self::FIND_SQL_STATEMENT_PREFIX . " " . $column . " = :" . $column . ";";
        $stmt = parent::connect()->prepare($sql);
        $stmt->execute([(":" . $column) => $value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function get_id($username, $email)
    {
        $stmt = parent::connect()->prepare(self::GET_ID_SQL_STATEMENT);
        $stmt->execute([':username' => $username, ':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // UPDATE
    public static function update($user_id, array $data)
    {
        $sql = self::generate_update_statement($data);
        $stmt = parent::connect()->prepare($sql);
        $data['user_id'] = $user_id;
        $stmt->execute(parent::map_array_with_exec_prefix($data));
    }

    // DELETE
    public static function delete($user_id)
    {
        $stmt = parent::connect()->prepare(self::DELETE_SQL_STATEMENT);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
    }

    private static function generate_update_statement(array $data) 
    {
        $sql = "UPDATE users SET";
        foreach($data as $key => $value) {
            if (end($data) == $value) {
                $sql .= " " . $key . " = :" . $key;
            } else {
                $sql .= " " .  $key . " = :" . $key . ",";
            }
        }
        $sql .= " WHERE user_id = :user_id";
        return $sql;
    }
}
