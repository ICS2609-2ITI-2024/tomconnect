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

    // UPDATE
    // DELETE
}