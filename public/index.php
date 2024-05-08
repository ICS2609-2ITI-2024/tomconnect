<?php

declare(strict_types=1);

use Tomconnect\Components\EventCard;
use Tomconnect\Models\PostModel;
use Tomconnect\Components\OrgRegistrationButton;
use Tomconnect\Models\OrganizationModel;

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Components\PostComponent;
use Tomconnect\Models\OrganizationModel;
use Tomconnect\Models\PostModel;

session_start();

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
    <img class="back-img" src="./img/testbg 2.svg" alt="">
    <div class="left">
        <h1>Left</h1>
    </div>

    <main class="main" style="">
        <h1>Feed</h1>
        <?php foreach(PostModel::fetch_all() as $post): ?>
            <article class="post">
                <h3 class="author"><?= OrganizationModel::fetch($post['author_id'])['name'] ?></h3>
                <p class="content"><?= $post['content'] ?></p>
                <?php if ($post['media_url'] != null): ?>
                    <img src=<?= $post['media_url'] ?> alt="">
                <?php endif ?>
            </article>
        <?php endforeach ?>
    </main>
    <div class="right">
        <h1>Right</h1>

    </div>
    <script src="./js/script.js"></script>
</body>
</html>