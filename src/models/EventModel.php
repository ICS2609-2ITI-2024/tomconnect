<?php

/**
 * The EventModel class provides methods for interacting with event data in the database or data store.
 * 
 * This class extends the base Model class and encapsulates database operations related to events,
 * including creating, reading, updating, and deleting event records.
 * 
 * @author Alec Estrera
 * @version 1.0
 * @since 2024
 */

declare(strict_types=1);

namespace Tomconnect\Models;

use PDO;

class EventModel extends Model
{

    /**
     * SQL statement for creating a new event record.
     * 
     * This constant represents the SQL statement used to insert a new event record
     * into the 'events' table with placeholders for the event data.
     */
    const CREATE_SQL_STATEMENT = "INSERT INTO events (post_id, description, event_start_date, event_end_date, event_time, link, location) VALUES (:post_id, :description, :event_start_date, :event_end_date, :event_time, :link, :location);";

    /**
     * SQL statement for fetching all event records.
     * 
     * This constant represents the SQL statement used to retrieve all event records
     * from the 'events' table where the 'is_deleted' flag is not set.
     */
    const FETCH_ALL_SQL_STATEMENT = "SELECT * FROM events WHERE is_deleted = 0;";

    /**
     * SQL statement for fetching a specific event record.
     * 
     * This constant represents the SQL statement used to retrieve a specific event record
     * from the 'events' table based on the event ID where the 'is_deleted' flag is not set.
     */
    const FETCH_SQL_STATEMENT = "SELECT * FROM events WHERE is_deleted = 0 AND event_id = :event_id;";

    /**
     * SQL statement for marking an event record as deleted.
     * 
     * This constant represents the SQL statement used to update the 'is_deleted' flag
     * to 1 for a specific event record in the 'events' table based on the user ID.
     */
    const DELETE_SQL_STATEMENT = "UPDATE events SET is_deleted = 1 WHERE event_id = :event_id;";
    /**
     * Creates a new event record in the database.
     * 
     * Inserts a new event record into the 'events' table with the provided data.
     * 
     * @param array $data An associative array containing event data.
     * @return void
     * @access public
     */
    public static function create(array $data): void
    {
        $stmt = parent::connect()->prepare(self::CREATE_SQL_STATEMENT);
        $stmt->execute(parent::map_array_with_exec_prefix($data));
    }

    /**
     * Retrieves all event records from the database.
     * 
     * Fetches all event records from the 'events' table where the 'is_deleted' flag is not set.
     * 
     * @return array An array of event records.
     * @access public
     */
    public static function fetch_all(): array
    {
        $stmt = parent::connect()->prepare(self::FETCH_ALL_SQL_STATEMENT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves a specific event record from the database.
     * 
     * Fetches the event record with the specified event ID from the 'events' table where the 'is_deleted' flag is not set.
     * 
     * @param int $event_id The ID of the event to retrieve.
     * @return array|null The event record, or null if not found.
     * @access public
     */
    public static function fetch($event_id): array|null
    {
        $stmt = parent::connect()->prepare(self::FETCH_SQL_STATEMENT);
        $stmt->execute([':event_id' => $event_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Updates an existing event record in the database.
     * 
     * Updates the event record with the specified event ID in the 'events' table with the provided data.
     * 
     * @param int $event_id The ID of the event to update.
     * @param array $data An associative array containing updated event data.
     * @return void
     * @access public
     */
    public static function update($event_id, array $data): void
    {
        $sql = self::generate_update_statement($data);
        $stmt = parent::connect()->prepare($sql);
        $data['event_id'] = $event_id;
        $stmt->execute(self::map_array_with_exec_prefix($data));
    }

    /**
     * Marks an event record as deleted in the database.
     * 
     * Sets the 'is_deleted' flag to 1 for the event record with the specified event ID in the 'events' table.
     * 
     * @param int $event_id The ID of the event to delete.
     * @return void
     * @access public
     */
    public static function delete($event_id): void
    {
        $stmt = parent::connect()->prepare(self::DELETE_SQL_STATEMENT);
        $stmt->execute([':event_id' => $event_id]);
    }

    /**
     * Generates an SQL UPDATE statement for updating event records.
     * 
     * Generates an SQL UPDATE statement based on the provided data array.
     * 
     * @param array $data An associative array containing updated event data.
     * @return string The generated SQL UPDATE statement.
     * @access private
     */
    private static function generate_update_statement(array $data): string
    {
        $sql = "UPDATE events SET";
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
