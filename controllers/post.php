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

$logged_user_id = $_SESSION['logged_id'];

$post_controller = new Post();

$post_controller->post(OrganizationModel::search_from_column('admin_id', $logged_user_id)[0]['org_id']);

header("Location: " . $_SERVER['HTTP_REFERER']);
die();
