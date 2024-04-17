<?php

declare(strict_types=1);

namespace Tomconnect\Models;

use PDO;

class OrganizationModel extends Model
{
    // TODO: Create: Functions for creating new records/entities in the database or data store.

    public function create(array $data)
    {
        $sql = "INSERT INTO organizations (name, description, admin_id, website, logo_url, location) VALUES (:name, :description, :admin_id, :website, :logo_url, :location);";
        $stmt = parent::connect()->prepare($sql);
        $stmt->execute(parent::map_array_with_exec_prefix($data));
    }

    // TODO: Read: Functions for retrieving data from the database or data store. These may include methods 
    public function fetch_all()
    {
        $sql = "SELECT * FROM organizations WHERE is_deleted = 0;";
        $stmt = parent::connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch($org_id)
    {
        $sql = "SELECT * FROM organizations WHERE is_deleted = 0 AND org_id = :org_id";
        $stmt = parent::connect()->prepare($sql);
        $stmt->bindParam(":org_id", $org_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // TODO: Update: Functions for updating existing records/entities in the database or data store.

    public function update($org_id, array $data)
    {

    }

    // TODO Functions for deleting records/entities from the database or data store.

    public function delete($org_id)
    {
        
    }

    private function generate_update_statement(array $data) 
    {
        $sql = "UPDATE organizations SET";
        foreach($data as $key => $value) {
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
