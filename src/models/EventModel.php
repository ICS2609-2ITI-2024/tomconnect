<?php

declare(strict_types=1);

namespace Tomconnect\Models;

use PDO;

class EventModel extends Model
{
    // TODO: Create: Functions for creating new records/entities in the database or data store.

    public static function create(array $data)
    {
        $sql = "INSERT INTO events (post_id, description, event_start_date, event_end_date, event_time, link, location) VALUES (:post_id, :description, :event_start_date, :event_end_date, :event_time, :link, :location);";
        $stmt = parent::connect()->prepare($sql);
        $stmt->execute(parent::map_array_with_exec_prefix($data));
    }

    // TODO: Read: Functions for retrieving data from the database or data store. These may include methods 
    public static function fetch_all()
    {
        $sql = "SELECT * FROM events WHERE is_deleted = 0;";
        $stmt = parent::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function fetch($event_id)
    {
        $sql = "SELECT * FROM events WHERE is_deleted = 0 AND event_id = :event_id";
        $stmt = parent::connect()->prepare($sql);
        $stmt->bindParam(":event_id", $event_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // TODO: Update: Functions for updating existing records/entities in the database or data store.

    public static function update($event_id, array $data)
    {
        $sql = self::generate_update_statement($data);
        $stmt = parent::connect()->prepare($sql);
        $data['event_id'] = $event_id;
        $stmt->execute(self::map_array_with_exec_prefix($data));
    }

    // TODO Functions for deleting records/entities from the database or data store.

    public static function delete($event_id)
    {
        $sql = "UPDATE events SET is_deleted = 1 WHERE user_id = :user_id;";
        $stmt = parent::connect()->prepare($sql);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
    }

    private static function generate_update_statement(array $data)
    {
        $sql = "UPDATE event SET";
        foreach ($data as $key => $value) {
            if (end($data) == $value) {
                $sql .= " " . $key . " = :" . $key;
            } else {
                $sql .= " " .  $key . " = :" . $key . ",";
            }
        }
        $sql .= " WHERE event_id = :event_id";
        return $sql;
    }
}
