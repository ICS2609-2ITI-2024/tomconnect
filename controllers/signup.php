<?php

if ($_SERVER['REQUEST_METHOD'] !== "POST")
{
    header("Location: 404.php");
    die();
}