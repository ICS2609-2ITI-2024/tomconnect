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

    protected function map_array_with_exec_prefix(array $data) {
        $transformed_array = [];

        foreach($data as $key => $value) {
            $transformed_array[self::prefixKey($key)] = $value;
        }

        return $transformed_array;
    }

    private static function prefixKey(string $key): string
    {
        return ":" . $key;
    }

    abstract public function create(array $data);

    abstract public function fetch_all();

    abstract public function fetch($identifier);

    abstract public function update($identifier, array $data);

    abstract public function delete($identifier);

}
