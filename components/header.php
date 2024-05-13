<?php

namespace Tomconnect\Components;

class Header
{
    public static function render($page_title)
    {
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= ucwords($page_title) ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="./assets/logo.ico">
        <link rel="stylesheet" href="./css/main.css">
</head>
<body>
        <?php
    }
}