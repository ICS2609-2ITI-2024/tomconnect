<?php


declare(strict_types=1);


require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();

use Tomconnect\Components\CreatePostComponent;
use Tomconnect\Components\Footer;
use Tomconnect\Components\Header;
use Tomconnect\Components\NavbarComponent;
use Tomconnect\Components\PostComponent;
use Tomconnect\Models\OrganizationModel;
use Tomconnect\Models\PostModel;

if ($_SERVER['REQUEST_METHOD'] !== "GET" || !isset($_GET['p'])) {
    header("Location: index.php");
    die();
}

$org_id = OrganizationModel::get_id($_GET['p']);

if (!$org_id) {
    header("Location: index.php");
    die();
}

$organization = OrganizationModel::fetch((int) $org_id);

Header::render("TomConnect: " . $_GET['p']);
NavbarComponent::render();
?>
<div class="profile">
    <div class="cover-photo-container" style="background-image: url('<?= $organization['cover_img_url'] ?>');">
    </div>
    <main class="">
        <div class="profile-image">
            <img src=<?= ($organization['logo_url'] != null) ? $organization['logo_url'] : 'assets/IcBaselineAccountCircle.png' ?> alt="">
        </div>
        <div class="profile-content-container">
            <div class="organization-info">
                <h3 class="profile-organization-name"><?= $organization['name'] ?></h3>
                <p class="profile-organization-description"><?= $organization['description'] ?></p>
                <p class="profile-website">
                    <a href=<?= $organization['website'] ?>>
                        <?= $organization['website'] ?>
                    </a>
                </p>
                <p class="profile-location">
                    <?= $organization['location'] ?>
                </p>
                <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['logged_id'] == $organization['admin_id']): ?>
                    <a href="../controllers/logout.php">Logout</a>
                <?php endif ?>
            </div>
            <div class="posts">
                <?php
                CreatePostComponent::render();
                foreach (PostModel::search_from_column('author_id', $organization['org_id']) as $post) {
                    $author = OrganizationModel::fetch($post['author_id']);
                    PostComponent::render($author['name'], $author['logo_url'], $post['content'], $post['media_url'], $post['created_at']);
                }
                ?>
            </div>
        </div>
    </main>
</div>
<?php
Footer::render();
?>