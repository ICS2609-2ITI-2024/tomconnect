<?php

declare(strict_types=1);

namespace Tomconnect\Models; //error

class PostModel extends Model
{
    // TODO: Create: Functions for creating new records/entities in the database or data store.

    public static function create(array $data)
    {
        $sql = "INSERT INTO posts (author_id, content, media_url) VALUES (:author_id, :content, :media_url);";
        $stmt = parent::connect()->prepare($sql);
        $stmt->execute(parent::map_array_with_exec_prefix($data));
    }

    // TODO: Read: Functions for retrieving data from the database or data store. These may include methods 
    public static function fetch_all()
    {
        $sql = "SELECT * FROM posts WHERE is_deleted = 0;";
        $stmt = parent::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function fetch($post_id)
    {
        $sql = "SELECT * FROM posts WHERE post_id = :post_id AND is_deleted = 0;";
        $stmt = parent::connect()->prepare($sql);
        $stmt->bindParam(":post_id", $post_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // TODO: Update: Functions for updating existing records/entities in the database or data store.

    public static function update($post_id, array $data)
    {
        $sql = self::generate_update_statement($data);
        $stmt = parent::connect()->prepare($sql);
        $data['post_id'] = $post_id;
        $stmt->execute(self::map_array_with_exec_prefix($data));
    }

    // TODO Functions for deleting records/entities from the database or data store.

    public static function delete($post_id)
    {
     $sql = "UPDATE posts SET is_deleted = 1 WHERE post_id = :post_id;";
        $stmt = parent::connect()->prepare($sql);
        $stmt->bindParam(":post_id", $post_id);
        $stmt->execute();   
    }

    private function generate_update_statement(array $data) 
    {
        $sql = "UPDATE posts SET";
        foreach($data as $key => $value) {
        if (end($data) == $value) {
            $sql .= " " . $key . " = :" . $key . ",";
        } else {
            $sql .= " " . $key . " = :" . $key . ",";
        }

        $sql .= " WHERE post_id = :post_id;";
        return $sql;
    }

}
}
