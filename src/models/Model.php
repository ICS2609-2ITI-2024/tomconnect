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
}