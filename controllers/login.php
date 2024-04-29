<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== "POST")
{
    header("Location: " . "../public/404.php");
    die();
}

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Controllers\OrganizationLogin;
use Tomconnect\Models\UserModel;

$login = new OrganizationLogin();
$login->validate_fields();


if (isset($_SESSION['login_error_message'])) echo $_SESSION['login_error_message'];
unset($_SESSION['login_error_message']);