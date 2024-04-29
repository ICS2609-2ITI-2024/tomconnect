<?php

/**
 * The TagModel class provides methods for interacting with tag data in the database.
 * 
 * This class extends the base Model class and encapsulates database operations related to tags,
 * including creating, reading, updating, and deleting tag records.
 * 
 * @author Hector Santiago
 * @version 1.0
 * @since 2024
 */

declare(strict_types=1);

namespace Tomconnect\Models;

use PDO;
use Exception;

class TagModel extends Model
{

    /**
     * SQL statement for creating a new tag record.
     */
    const CREATE_SQL_STATEMENT = "INSERT INTO tags (tag_name) VALUES (:tag_name);";

    /**
     * SQL statement for fetching all tag records.
     */
    const FETCH_ALL_SQL_STATEMENT = "SELECT * FROM tags WHERE is_deleted = 0;";

    /**
     * SQL statement for fetching a specific tag record by ID.
     */
    const FETCH_SQL_STATEMENT = "SELECT * FROM tags WHERE tag_id = :tag_id AND is_deleted = 0;";

    /**
     * SQL statement for marking a tag record as deleted.
     */
    const DELTE_SQL_STATEMENT = "UPDATE tags SET is_deleted = 1 WHERE tag_id = :tag_id;";

    /**
     * Creates a new tag record in the database.
     * 
     * @param array $data An associative array containing tag data.
     * @return void
     */
    public static function create(array $data): void
    {
        try {
            $stmt = parent::connect()->prepare(self::CREATE_SQL_STATEMENT);
            $stmt->execute(parent::map_array_with_exec_prefix($data));
        } catch (Exception $e) {
            echo "USER CREATION FAILED: " . $e;
        }
    }

    /**
     * Retrieves all tag records from the database.
     * 
     * @return array An array of tag records.
     */
    public static function fetch_all(): array
    {
        $stmt = parent::connect()->prepare(self::FETCH_ALL_SQL_STATEMENT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves a specific tag record from the database.
     * 
     * @param int $tag_id The ID of the tag to retrieve.
     * @return array|null The tag record, or null if not found.
     */
    public static function fetch($tag_id): array|null
    {
        $stmt = parent::connect()->prepare(self::FETCH_SQL_STATEMENT);
        $stmt->execute([':tag_id' => $tag_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Updates an existing tag record in the database.
     * 
     * @param int $tag_id The ID of the tag to update.
     * @param array $data An associative array containing updated tag data.
     * @return void
     */
    public static function update($tag_id, array $data): void
    {
        $sql = self::generate_update_statement($data);
        $stmt = parent::connect()->prepare($sql);
        $data['tag_id'] = $tag_id;
        $stmt->execute(self::map_array_with_exec_prefix($data));
    }

    /**
     * Marks a tag record as deleted in the database.
     * 
     * @param int $tag_id The ID of the tag to delete.
     * @return void
     */
    public static function delete($tag_id): void
    {
        $stmt = parent::connect()->prepare(self::DELTE_SQL_STATEMENT);
        $stmt->execute([':tag_id' => $tag_id]);
    }

    /**
     * Generates an SQL UPDATE statement for updating tag records.
     * 
     * @param array $data An associative array containing updated tag data.
     * @return string The generated SQL UPDATE statement.
     */
    private static function generate_update_statement(array $data): string
    {
        $sql = "UPDATE tags SET";
        foreach ($data as $key => $value) {
            if (end($data) == $value) {
                $sql .= " " . $key . " = :" . $key;
            } else {
                $sql .= " " . $key . " = :" . $key . ",";
            }

            $sql .= " WHERE tag_id = :tag_id;";
        }
        return $sql;
    }
}
