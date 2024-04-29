<?php

/**
 * The UserModel class provides methods for interacting with user data in the database.
 * 
 * This class extends the base Model class and encapsulates database operations related to users,
 * including creating, reading, updating, and deleting user records.
 * 
 * @author Winfrey De Vera
 * @version 1.0
 * @since 2024
 */

declare(strict_types=1);

namespace Tomconnect\Models;

use PDO;
use Exception;
use Tomconnect\Models\Model;

class UserModel extends Model
{
    /**
     * SQL statement for creating a new user record.
     */
    const CREATE_SQL_STATEMENT = "INSERT INTO users (username, email, password_hash) VALUES (:username, :email, :password_hash);";

    /**
     * SQL statement for fetching all user records.
     */
    const FETCH_ALL_SQL_STATEMENT = "SELECT * FROM users WHERE is_deleted = 0;";

    /**
     * SQL statement for fetching a specific user record by ID.
     */
    const FETCH_SQL_STATEMENT = "SELECT * FROM users WHERE is_deleted = 0 AND user_id = :user_id;";

    /**
     * SQL statement prefix for finding user records based on a specific column and value.
     */
    const FIND_SQL_STATEMENT_PREFIX = "SELECT * FROM users WHERE is_deleted = 0 AND";

    /**
     * SQL statement for marking a user record as deleted.
     */
    const DELETE_SQL_STATEMENT = "UPDATE users SET is_deleted = 1 WHERE user_id = :user_id;";

    /**
     * SQL statement for retrieving the user ID based on username and email.
     */
    const GET_ID_SQL_STATEMENT = "SELECT user_id FROM users where username = :username AND email = :email;";

    /**
     * Creates a new user record in the database.
     * 
     * @param array $data An associative array containing user data.
     * @return bool True if the user creation is successful, false otherwise.
     */
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

    /**
     * Retrieves all user records from the database.
     * 
     * @return array An array of user records.
     */
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

    /**
     * Retrieves a specific user record from the database.
     * 
     * @param int $user_id The ID of the user to retrieve.
     * @return array|null The user record, or null if not found.
     */
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

    /**
     * Finds a user record based on a specific column and value.
     * 
     * @param string $column The column to search for.
     * @param string $value The value to search for in the specified column.
     * @return array|null The user record, or null if not found.
     */
    public static function find(string $column, string $value)
    {
        $sql = self::FIND_SQL_STATEMENT_PREFIX . " " . $column . " = :" . $column . ";";
        $stmt = parent::connect()->prepare($sql);
        $stmt->execute([(":" . $column) => $value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves the user ID based on username and email.
     * 
     * @param string $username The username of the user.
     * @param string $email The email address of the user.
     * @return array|null The user ID, or null if not found.
     */
    public static function get_id($username, $email)
    {
        $stmt = parent::connect()->prepare(self::GET_ID_SQL_STATEMENT);
        $stmt->execute([':username' => $username, ':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Updates an existing user record in the database.
     * 
     * @param int $user_id The ID of the user to update.
     * @param array $data An associative array containing updated user data.
     * @return void
     */
    public static function update($user_id, array $data)
    {
        $sql = self::generate_update_statement($data);
        $stmt = parent::connect()->prepare($sql);
        $data['user_id'] = $user_id;
        $stmt->execute(parent::map_array_with_exec_prefix($data));
    }

    /**
     * Marks a user record as deleted in the database.
     * 
     * @param int $user_id The ID of the user to delete.
     * @return void
     */
    public static function delete($user_id)
    {
        $stmt = parent::connect()->prepare(self::DELETE_SQL_STATEMENT);
        $stmt->execute([':user_id' => $user_id]);
    }

    /**
     * Generates an SQL UPDATE statement for updating user records.
     * 
     * @param array $data An associative array containing updated user data.
     * @return string The generated SQL UPDATE statement.
     */
    private static function generate_update_statement(array $data)
    {
        $sql = "UPDATE users SET";
        foreach ($data as $key => $value) {
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
