<?php

declare(strict_types=1);

namespace Tomconnect\Models;

use Tomconnect\Models\Model;

class Users extends Model
{
    // CREATE
    public function create_user(string $username, string $email, string $password_hash, string $first_name, string $last_name, string $profile_picture_url)
    {
        $sql = "INSERT INTO users (username, email, password_hash, first_name, last_name, profile_picture_url) VALUES (:username, :email, :password_hash, :first_name, :last_name, :profile_picture_url);";
        $stmt = parent::connect()->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password_hash", $password_hash);
        $stmt->bindParam(":first_name", $first_name);
        $stmt->bindParam(":last_name", $last_name);
        $stmt->bindParam(":profile_picture_url", $profile_picture_url);
        $stmt->execute();
    }
    // READ

    public function fetch_all_users()
    {
        try {
            $sql = "SELECT * FROM users;";
            $stmt = parent::connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            echo "FETCHING FAILED: " . $e;
        }
    }
    
    public function fetch_user($user_id)
    {
        try {
            $sql = "SELECT * FROM users WHERE is_deleted = 0 AND user_id = :user_id";
            $stmt = parent::connect()->prepare($sql);
            $stmt->bindParam(":user_id", $identifier);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            echo "FETCHING FAILED: " . $e;
        }
    }

    // UPDATE
    // DELETE
}