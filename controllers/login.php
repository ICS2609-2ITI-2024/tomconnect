<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: " . "../public/404.php");
    die();
}

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Controllers\OrganizationLogin;

$login = new OrganizationLogin();

if ($login->handle_login()) {
    header("Location: " . "../public/index.php");
    die();
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    die();
}
