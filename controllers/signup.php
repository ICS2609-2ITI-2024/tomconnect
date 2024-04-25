<?php

if ($_SERVER['REQUEST_METHOD'] !== "POST")
{
    header("Location: " . "../public/404.php");
    die();
}

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Models\UserModel;

session_start();

check_empty_username();
check_empty_email();
check_empty_password();



function check_empty_username()
{
    if (empty($_POST['username']) || !isset($_POST['username'])) {
        $_SESSION['username_err'] = "Please enter a username";
        return false;
    }
    return true;
}

function check_empty_password()
{
    if (empty($_POST['password1']) || !isset($_POST['password1'])) {
        $_SESSION['password1_err'] = "Please enter a password";
        return false;
    }
    if (empty($_POST['password2']) || !isset($_POST['password2'])) {
        $_SESSION['password2_err'] = "Please enter a confirmed password";
        return false;
    }
    return true;
}

function check_empty_email()
{
    if (empty($_POST['email']) || !isset($_POST['email'])) {
        $_SESSION['email_err'] = "Please enter a email";
        return false;
    }
    return true;
}

function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}