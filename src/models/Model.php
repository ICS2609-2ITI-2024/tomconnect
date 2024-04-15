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

    abstract public function create();

    abstract public function fetch_all();

    abstract public function fetch();

    abstract public function update();

    abstract public function delete();

}
