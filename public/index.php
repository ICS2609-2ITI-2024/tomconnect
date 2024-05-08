<?php

declare(strict_types=1);


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
    <div class="">
        <?php foreach(PostModel::fetch_all() as $post): ?>
            <?php PostComponent::render(OrganizationModel::fetch($post['author_id'])['name'], OrganizationModel::fetch($post['author_id'])['logo_url'], $post['content'], $post['media_url'], $post['created_at']) ?>
        <?php endforeach ?>
    </div>
</body>
</html>