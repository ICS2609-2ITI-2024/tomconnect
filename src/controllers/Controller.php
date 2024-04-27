<?php

declare(strict_types=1);

namespace Tomconnect\Controllers;

class Controller
{
    protected static function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
