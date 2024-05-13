<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    header("Location: " . "../public/404.php");
    die();
}

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Controllers\search;

$search = new Search();

$result = $search->search();

echo json_encode($result);
