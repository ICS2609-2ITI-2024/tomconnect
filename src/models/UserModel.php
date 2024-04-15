<?php

declare(strict_types=1);

namespace Tomconnect\Models;

use Tomconnect\Models\Model;

class UserModel extends Model
{
    // CREATE
    public function create(array $data)
    {
        $sql = "INSERT INTO users (username, email, password_hash, first_name, last_name, profile_picture_url) VALUES (:username, :email, :password_hash, :first_name, :last_name, :profile_picture_url);";
        $stmt = parent::connect()->prepare($sql);
        $stmt->bindParam(":username", $data['username']);
        $stmt->bindParam(":email", $data['email']);
        $stmt->bindParam(":password_hash", $data['password_hash']);
        $stmt->bindParam(":first_name", $data['first_name']);
        $stmt->bindParam(":last_name", $data['last_name']);
        $stmt->bindParam(":profile_picture_url", $data['profile_picture_url']);
        $stmt->execute();
    }
    // READ

    public function fetch_all()
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
    
    public function fetch($user_id)
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
    public function update($user_id, array $data)
    {
        $sql = "UPDATE users SET";
        foreach($data as $key => $value) {
            $sql .= " " . $key . " = :" . $key;
        }
        $sql .= " WHERE user_id = :user_id";
        echo $sql;
        $stmt = parent::connect()->prepare($sql);
        foreach($data as $key => $value) {
            echo ":" . $key . " = " . $value;
            $stmt->bindParam(":" . $key, $value);
        }
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
    }
    // DELETE
    public function delete($user_id)
    {
        $sql = "UPDATE users SET is_deleted = 1 WHERE user_id = :user_id;";
        $stmt = parent::connect()->prepare($sql);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
    }
}