<?php

/**
 * The OrganizationModel class provides methods for interacting with organization data in the database.
 * 
 * This class extends the base Model class and encapsulates database operations related to organizations,
 * including creating, reading, updating, and deleting organization records.
 * 
 * @author Winfrey De Vera
 * @version 1.0
 * @since 2024
 */

declare(strict_types=1);

namespace Tomconnect\Models; //error

use PDO;
use Tomconnect\Models\Model;

class OrganizationModel extends Model
{
    /**
     * SQL statement for creating a new organization record.
     */
    const CREATE_SQL_STATEMENT = "INSERT INTO organizations (name, admin_id) VALUES (:name, :admin_id);";

    /**
     * SQL statement for fetching all organization records.
     */
    const FETCH_ALL_SQL_STATEMENT = "SELECT * FROM organizations WHERE is_deleted = 0;";

    /**
     * SQL statement for fetching a specific organization record by ID.
     */
    const FETCH_SQL_STATEMENT = "SELECT * FROM organizations WHERE is_deleted = 0 AND org_id = :org_id";

    /**
     * SQL statement for fetching the ID of an organization by its name.
     */
    const GET_ID_SQL_STATEMENT = "SELECT org_id FROM organizations WHERE name = :name;";

    /**
     * SQL statement for marking an organization record as deleted.
     */
    const DELETE_SQL_STATEMENT = "UPDATE organizations SET is_deleted = 1 WHERE org_id = :org_id;";

    /**
     * Creates a new organization record in the database.
     * 
     * @param array $data An associative array containing organization data.
     * @return void
     */
    public static function create(array $data)
    {
        $stmt = parent::connect()->prepare(self::CREATE_SQL_STATEMENT);
        $stmt->execute(parent::map_array_with_exec_prefix($data));
    }

    /**
     * Retrieves all organization records from the database.
     * 
     * @return array An array of organization records.
     */
    public static function fetch_all(): array
    {
        $stmt = parent::connect()->prepare(self::FETCH_ALL_SQL_STATEMENT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves a specific organization record from the database.
     * 
     * @param int $org_id The ID of the organization to retrieve.
     * @return array|null The organization record, or null if not found.
     */
    public static function fetch($org_id): array|null
    {
        $stmt = parent::connect()->prepare(self::FETCH_SQL_STATEMENT);
        $stmt->execute([':org_id' => $org_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Retrieves the ID of an organization by its name.
     * 
     * @param string $organization_name The name of the organization.
     * @return array|null The ID of the organization, or null if not found.
     */
    public static function get_id($organization_name)
    {
        $stmt = parent::connect()->prepare(self::GET_ID_SQL_STATEMENT);
        $stmt->execute([':name' => $organization_name]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['org_id'];
    }

    public static function search($query)
    {
        $sql = "SELECT * FROM organizations WHERE name LIKE :name;";
        $stmt = parent::connect()->prepare($sql);
        $stmt->execute([':name' => "%" . $query . "%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Updates an existing organization record in the database.
     * 
     * @param int $org_id The ID of the organization to update.
     * @param array $data An associative array containing updated organization data.
     * @return void
     */
    public static function update($org_id, array $data): void
    {
        $sql = self::generate_update_statement($data);
        $stmt = parent::connect()->prepare($sql);
        $data['org_id'] = $org_id;
        $stmt->execute(self::map_array_with_exec_prefix($data));
    }

    /**
     * Marks an organization record as deleted in the database.
     * 
     * @param int $org_id The ID of the organization to delete.
     * @return void
     */
    public static function delete($org_id): void
    {
        $stmt = parent::connect()->prepare(self::DELETE_SQL_STATEMENT);
        $stmt->execute([':org_id' => $org_id]);
    }

    /**
     * Generates an SQL UPDATE statement for updating organization records.
     * 
     * @param array $data An associative array containing updated organization data.
     * @return string The generated SQL UPDATE statement.
     */
    private static function generate_update_statement(array $data): string
    {
        $sql = "UPDATE organizations SET";
        foreach ($data as $key => $value) {
            if (end($data) == $value) {
                $sql .= " " . $key . " = :" . $key;
            } else {
                $sql .= " " .  $key . " = :" . $key . ",";
            }
        }
        $sql .= " WHERE org_id = :org_id";
        return $sql;
    }
}
