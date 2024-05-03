<?php

declare(strict_types=1);

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();

if (!isset($_SESSION['is_logged_in'])) {
    header("Location: " . "login.php");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>TomConnect</title>
</head>
<body>
    <form action="../controllers/post.php" method="post" enctype="multipart/form-data">
        <textarea name="post_content" id="post_content" cols="30" rows="10">
        </textarea>
        <input type="file" name="img" id="img">
        <button type="submit">Post</button>
    </form>
</body>
</html>