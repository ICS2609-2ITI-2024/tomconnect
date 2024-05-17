<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    header("Location: " . "../public/404.php");
    die();
}

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Components\Footer;
use Tomconnect\Components\Header;
use Tomconnect\Controllers\Search;
use Tomconnect\Components\PostComponent;
use Tomconnect\Models\OrganizationModel;
use Tomconnect\Components\NavbarComponent;
use Tomconnect\Components\OrganizationSearchCardComponent;

$search = new Search();

$result = $search->search();
$posts = $result['posts'];
$organizations = $result['organizations'];

Header::render('Tomconnect');
NavbarComponent::render();
?>
<script>
    const result = <?= json_encode($result) ?>
    console.table(result);
</script>
<img src="./assets/testbg 2.svg" alt="" class="back-img">
<div class="main-feed">
    <div class="left">
    </div>
    <main class="main">
        <div class="orgs">
            <h2 class="orgs__title">Organizations</h2>
            <?php 
            foreach($organizations as $organization) {
                OrganizationSearchCardComponent::render($organization['name'], $organization['logo_url'], $organization['admin_id'], $organization['description']);
            }
            ?>
        </div>
        <div class="posts">
            <?php
            foreach ($posts as $post) {
                $author = OrganizationModel::fetch($post['author_id']);
                PostComponent::render($author['name'], $author['logo_url'], $post['content'], $post['media_url'], $post['created_at']);
            }
            ?>
        </div>
    </main>
    <div class="right">
    </div>
</div>
<?php
Footer::render();
