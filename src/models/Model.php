<?php

declare(strict_types=1);

namespace Tomconnect\Models;

abstract class Model extends Database 
{
    protected function sanitize_input($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    abstract public function create(array $data);

    abstract public function fetch_all();

    abstract public function fetch($identifier);

    abstract public function update($identifier, array $data);

    abstract public function delete($identifier);

}
