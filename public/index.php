<?php

declare(strict_types=1);


require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Components\PostComponent;
use Tomconnect\Models\PostModel;
use Tomconnect\Models\OrganizationModel;

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

    <main class="main">
        <?php foreach (PostModel::fetch_all() as $post) {
            $org = OrganizationModel::fetch($post['author_id']);
            PostComponent::render($org['name'], $org['logo_url'], $post['content'], $post['media_url'], $post['created_at']);
        } ?>
    </main>
    <div class="right">
        <h1>Right</h1>
    </div>
    <script src="./js/script.js"></script>
</body>

</html>