<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    header("Location: " . "../public/404.php");
    die();
}

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Components\Footer;
use Tomconnect\Components\Header;
use Tomconnect\Components\NavbarComponent;
use Tomconnect\Controllers\Search;
use Tomconnect\Components\PostComponent;
use Tomconnect\Models\OrganizationModel;

$search = new Search();

$result = $search->search();
$posts = $result['posts'];
$organizations = $result['organizations'];

Header::render('Tomconnect');
NavbarComponent::render();
?>
<img src="./assets/testbg 2.svg" alt="" class="back-img">
<main class="center">
    <div class="">
        <?php 
        foreach ($posts as $post) {
            $author = OrganizationModel::fetch($post['author_id']);
            PostComponent::render($author['name'], $author['logo_url'], $post['content'], $post['media_url'], $post['created_at']);
        }
        ?>
    </div>
</main>
<?php
Footer::render();