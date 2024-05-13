<?php

declare(strict_types=1);


require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    header("Location: index.php");
    die();
}
