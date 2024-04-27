<?php

declare(strict_types=1);

namespace Tomconnect\Models;

use PDO;
use Exception;

class TagModel extends Model
{
    // TODO: Create: Functions for creating new records/entities in the database or data store.

    public static function create(array $data)
    {
        try {
            $sql = "INSERT INTO tags (tag_name) VALUES (:tag_name);";
            $stmt = parent::connect()->prepare($sql);
            $stmt->execute(parent::map_array_with_exec_prefix($data));
        } catch (Exception $e) {
            echo "USER CREATION FAILED: " . $e;
            return false;
        }
    }

    // TODO: Read: Functions for retrieving data from the database or data store. These may include methods 
    public static function fetch_all()
    {
        $sql = "SELECT * FROM tags WHERE is_deleted = 0;";
        $stmt = parent::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function fetch($tag_id)
    {
        $sql = "SELECT * FROM tags WHERE tag_id = :tag_id AND is_deleted = 0;";
        $stmt = parent::connect()->prepare($sql);
        $stmt->bindParam(":post_id", $post_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // TODO: Update: Functions for updating existing records/entities in the database or data store.

    public static function update($tag_id, array $data)
    {
        $sql = self::generate_update_statement($data);
        $stmt = parent::connect()->prepare($sql);
        $data['post_id'] = $tag_id;
        $stmt->execute(self::map_array_with_exec_prefix($data));
    }

    // TODO Functions for deleting records/entities from the database or data store.

    public static function delete($tag_id)
    {
        $sql = "UPDATE tags SET is_deleted = 1 WHERE tag_id = :tag_id;";
        $stmt = parent::connect()->prepare($sql);
        $stmt->bindParam(":post_id", $post_id);
        $stmt->execute();
    }

    private static function generate_update_statement(array $data)
    {
        $sql = "UPDATE tags SET";
        foreach ($data as $key => $value) {
            if (end($data) == $value) {
                $sql .= " " . $key . " = :" . $key . ",";
            } else {
                $sql .= " " . $key . " = :" . $key . ",";
            }

            $sql .= " WHERE tag_id = :tag_id;";
            return $sql;
        }
    }
}
