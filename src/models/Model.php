<?php

declare(strict_types=1);

namespace Tomconnect\Models;

use Tomconnect\Models\Database;

abstract class Model extends Database
{
    protected static function sanitize_input($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    protected static function map_array_with_exec_prefix(array $data)
    {
        $transformed_array = [];

        foreach ($data as $key => $value) {
            $transformed_array[self::prefixKey($key)] = $value;
        }

        return $transformed_array;
    }

    private static function prefixKey(string $key): string
    {
        return ":" . $key;
    }

    abstract static public function create(array $data);

    abstract static public function fetch_all();

    abstract static public function fetch($identifier);

    abstract static public function update($identifier, array $data);

    abstract static public function delete($identifier);
}
