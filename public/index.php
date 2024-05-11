<?php

declare(strict_types=1);


require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Components\CreatePostComponent;
use Tomconnect\Components\PostComponent;
use Tomconnect\Models\PostModel;
use Tomconnect\Models\OrganizationModel;
use Tomconnect\Components\Footer;
use Tomconnect\Components\Header;
use Tomconnect\Components\NavbarComponent;


Header::render('tomconnect');
NavbarComponent::render();
?>
<img src="./img/testbg 2.svg" alt="" class="back-img">
<div class="main-feed">
    <div class="left">
        Left
    </div>
    <main class="main">
        <?php
        CreatePostComponent::render();
        foreach (PostModel::fetch_all() as $post) {
            $author = OrganizationModel::fetch($post['author_id']);
            PostComponent::render($author['name'], $author['logo_url'], $post['content'], $post['media_url'], $post['created_at']);
        }
        ?>
    </main>
    <div class="right">
        Right
    </div>
</div>
<?php
Footer::render();
?>