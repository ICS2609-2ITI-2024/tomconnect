<?php

declare(strict_types=1);

use Tomconnect\Models\PostModel;
use Tomconnect\Components\OrgRegistrationButton;

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
    <style>
        .post-container {
            display: flex;
            flex-direction: column;
            margin: 2rem;
            gap: 1rem;
        }

        .post {
            border: solid 1px black;
            border-radius: 1rem;
            padding: 2rem;
        }

    </style>
</head>
<body>
    <form action="../controllers/post.php" method="post" enctype="multipart/form-data">
        <textarea name="content" id="content" cols="30" rows="10">
        </textarea>
        <input type="file" name="upload" id="upload">
        <button type="submit">Post</button>
    </form>

    <div class="post-container">
        <?php foreach(PostModel::search_from_column('author_id', '3') as $post): ?>
            <article class="post">
                <div class="content">
                    <?= $post['content'] ?>
                </div>
                <img src=<?= $post['media_url'] ?> alt="">
            </article>
        <?php endforeach ?>
    </div>
    
    <div class="">
        <?php OrgRegistrationButton::render('tomasino web') ?>
    </div>
</body>
</html>