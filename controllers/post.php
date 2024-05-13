<?php


session_start();

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header("Location: " . "../public/404.php");
    die();
}

if (!isset($_SESSION['is_logged_in'])) {
    header("Location: " . "../public/404.php");
    die();
}

if (!isset($_SESSION['logged_user'])) {
    header("Location: " . "../public/404.php");
    die();
}

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Models\OrganizationModel;
use Tomconnect\Controllers\Post;
use Tomconnect\Models\PostModel;

$logged_user = $_SESSION['logged_user'];

$post_controller = new Post();

$post_controller->post(OrganizationModel::get_id($logged_user));

header("Location: " . $_SERVER['HTTP_REFERER']);
die();
