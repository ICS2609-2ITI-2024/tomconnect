<?php

declare(strict_types=1);

namespace Tomconnect\Models;

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

    }

    public function fetch($org_id)
    {

    }

    // TODO: Update: Functions for updating existing records/entities in the database or data store.

    public function update($org_id, array $data)
    {

    }

    // TODO Functions for deleting records/entities from the database or data store.

    public function delete($org_id)
    {
        
    }
}