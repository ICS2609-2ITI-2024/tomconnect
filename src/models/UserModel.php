<?php

declare(strict_types=1);

namespace Tomconnect\Models;

use PDO;
use Exception;
use Tomconnect\Models\Model;

class UserModel extends Model
{
    // CREATE
    public static function create(array $data)
    {
        try {
            $sql = "INSERT INTO users (username, email, password_hash, first_name, last_name, profile_picture_url) VALUES (:username, :email, :password_hash, :first_name, :last_name, :profile_picture_url);";
            $stmt = parent::connect()->prepare($sql);
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
            $sql = "SELECT * FROM users WHERE is_deleted = 0;";
            $stmt = parent::connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "FETCHING FAILED: " . $e;
        }
    }
    
    public static function fetch($user_id)
    {
        try {
            $sql = "SELECT * FROM users WHERE is_deleted = 0 AND user_id = :user_id";
            $stmt = parent::connect()->prepare($sql);
            $stmt->bindParam(":user_id", $identifier);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "FETCHING FAILED: " . $e;
        }
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
        $sql = "UPDATE users SET is_deleted = 1 WHERE user_id = :user_id;";
        $stmt = parent::connect()->prepare($sql);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
    }

    private static function generate_update_statement(array $data) {
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
