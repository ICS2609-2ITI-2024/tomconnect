<?php

declare(strict_types=1);

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";


session_start();

// if (!isset($_SESSION['is_logged_in'])) {
//     header("Location: " . "login.php");
//     die();
// }

use Components\OrganizationCard;
use Tomconnect\Models\OrganizationModel;

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
    <div class="organization-gallery">
    <?php 
    foreach(OrganizationModel::fetch_all() as $organization) {
        (new OrganizationCard())->render($organization['org_id'], $organization['cover_img_url'], $organization['name']);
    }
    ?>
    </div>
</body>
</html>