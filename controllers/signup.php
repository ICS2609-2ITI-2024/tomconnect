<?php

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: " . "../public/404.php");
    die();
}

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Controllers\OrganizationSignUpForm;

session_start();

$sign = new OrganizationSignUpForm();

if ($sign->handle_sign_up()) {
    header("Location: " . "../public/signup_success.php");
    die();
} else {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    die();
}
