<?php

declare(strict_types=1);

use Tomconnect\Components\EventCard;
use Tomconnect\Models\PostModel;
use Tomconnect\Components\OrgRegistrationButton;

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

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
        <?php EventCard::render() ?>
    </div>
</body>
</html>