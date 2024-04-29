<?php

/**
 * The PostModel class provides methods for interacting with post data in the database.
 * 
 * This class extends the base Model class and encapsulates database operations related to posts,
 * including creating, reading, updating, and deleting post records.
 * 
 * @author Mhai Laine Bringuelo
 * @version 1.0
 * @since 2024
 */

declare(strict_types=1);

namespace Tomconnect\Models;

use PDO;
use Tomconnect\Models\Model;

class PostModel extends Model
{

    /**
     * SQL statement for creating a new post record.
     */
    const CREATE_SQL_STATEMENT = "INSERT INTO posts(author_id, content) VALUES (:author_id, :content);";

    /**
     * SQL statement for fetching all post records.
     */
    const FETCH_ALL_SQL_STATEMENT = "SELECT * FROM posts WHERE is_deleted = 0;";

    /**
     * SQL statement for fetching a specific post record by ID.
     */
    const FETCH_SQL_STATEMENT = "SELECT * FROM posts WHERE post_id = :post_id AND is_deleted = 0;";

    /**
     * SQL statement for marking a post record as deleted.
     */
    const DELETE_SQL_STATEMENT = "UPDATE posts SET is_deleted = 1 WHERE post_id = :post_id;";

    /**
     * Creates a new post record in the database.
     * 
     * @param array $data An associative array containing post data.
     * @return void
     */
    public static function create(array $data): void
    {
        $stmt = parent::connect()->prepare(self::CREATE_SQL_STATEMENT);
        $stmt->execute(parent::map_array_with_exec_prefix($data));
    }

    /**
     * Retrieves all post records from the database.
     * 
     * @return array An array of post records.
     */
    public static function fetch_all(): array
    {
        $stmt = parent::connect()->prepare(self::FETCH_ALL_SQL_STATEMENT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves a specific post record from the database.
     * 
     * @param int $post_id The ID of the post to retrieve.
     * @return array|null The post record, or null if not found.
     */
    public static function fetch($post_id): array|null
    {
        $stmt = parent::connect()->prepare(self::FETCH_SQL_STATEMENT);
        $stmt->execute([':post_id' => $post_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Updates an existing post record in the database.
     * 
     * @param int $post_id The ID of the post to update.
     * @param array $data An associative array containing updated post data.
     * @return void
     */
    public static function update($post_id, array $data): void
    {
        $sql = self::generate_update_statement($data);
        $stmt = parent::connect()->prepare($sql);
        $data['post_id'] = $post_id;
        $stmt->execute(self::map_array_with_exec_prefix($data));
    }

    /**
     * Marks a post record as deleted in the database.
     * 
     * @param int $post_id The ID of the post to delete.
     * @return void
     */
    public static function delete($post_id): void
    {
        $stmt = parent::connect()->prepare(self::DELETE_SQL_STATEMENT);
        $stmt->execute([':post_id' => $post_id]);
    }

    /**
     * Generates an SQL UPDATE statement for updating post records.
     * 
     * @param array $data An associative array containing updated post data.
     * @return string The generated SQL UPDATE statement.
     */
    private static function generate_update_statement(array $data): string
    {
        $sql = "UPDATE posts SET";
        foreach ($data as $key => $value) {
            if (end($data) == $value) {
                $sql .= " " . $key . " = :" . $key . ",";
            } else {
                $sql .= " " . $key . " = :" . $key . ",";
            }

            $sql .= " WHERE post_id = :post_id;";
        }
        return $sql;
    }
}
