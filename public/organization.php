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
    <?php

    use Tomconnect\Components\Header;
    use Tomconnect\Components\NavbarComponent;

    Header::render('tomconnect');
    NavbarComponent::render();

    ?>

    <img src="./assets/org-directory_background.png" alt="" class="bg-org">
    
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

        <div class="search search-padding">
            <form action="" method="get" class="search-form">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M9.5 16q-2.725 0-4.612-1.888T3 9.5q0-2.725 1.888-4.612T9.5 3q2.725 0 4.613 1.888T16 9.5q0 1.1-.35 2.075T14.7 13.3l5.6 5.6q.275.275.275.7t-.275.7q-.275.275-.7.275t-.7-.275l-5.6-5.6q-.75.6-1.725.95T9.5 16m0-2q1.875 0 3.188-1.312T14 9.5q0-1.875-1.312-3.187T9.5 5Q7.625 5 6.313 6.313T5 9.5q0 1.875 1.313 3.188T9.5 14" />
                </svg>
                <input type="text" name="q" id="q" autocomplete="off" placeholder="Search">
            </form>
        </div>

        <div class="org-grid-container">
            <?php

            use Tomconnect\Components\OrganizationCard;
            use Tomconnect\Models\OrganizationModel;

            foreach (OrganizationModel::fetch_all() as $org) {
                OrganizationCard::render($org['org_id'], './assets/ust_landscape.png', $org['name']);
            }
            ?>
        </div>

    </div>
</body>

</html>