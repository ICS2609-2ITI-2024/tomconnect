<?php
require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <div class="org-content-container">
        <div class="org-text-heading">
            Your Journey Starts Here
        </div>
        <div class="org-text-content">
            Explore and engage with a diverse array of student organizations, empowering your university experience. Discover opportunities to connect with like-minded peers, pursue your passions, and make a meaningful impact on campus.
        </div>
        <div class="org-text-end">
            Start your journey today with TomConnect!
        </div>

        <div class="org-grid-container">
        <?php

        use Tomconnect\Components\OrganizationCard;
        use Tomconnect\Models\OrganizationModel;

        foreach (OrganizationModel::fetch_all() as $org) {
            OrganizationCard::render($org['org_id'], './img/sample.jpg', $org['name']);
        }

        ?>

    </div>
    </div>

</body>

</html>