<?php

declare(strict_types=1);

require_once (dirname(__DIR__)) . "/../vendor/autoload.php";

session_start();

use Tomconnect\Components\Header;
use Tomconnect\Components\Footer;
use Tomconnect\Models\OrganizationModel;
use Tomconnect\Models\PostModel;

Header::render('Tomconnect Sign Up');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomConnect</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/Logo.ico">
    <link rel="stylesheet" href="../css/main.css">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>

    <img src="../assets/ust_landscape.png" alt="" class="back-img back-img-blurred">

    <div class="dashboard-container">
        <h1 class="dashboard-title">Organizations</h1>
        <br>
        <a href="" class="addnew-org-button">Add New Organization</a>
        <br>

        <?php
        $full_orgs = OrganizationModel::fetch_all();
        $full_post = PostModel::fetch_all();
        if (!empty($full_post) & !empty($full_orgs)) {
            echo '<table class="table table-bordered table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Org ID</th>';
            echo '<th>Name</th>';
            echo '<th class="content-column">Content</th>'; // Added class here
            echo '<th>Post URL</th>';
            echo '<th></th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($full_orgs as $org_row) {
                foreach ($full_post as $post_row) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars((string) $org_row["org_id"]) . '</td>';
                    echo '<td>' . htmlspecialchars((string) $org_row["name"]) . '</td>';
                    echo '<td class="col-md-4">' . htmlspecialchars((string) $post_row["content"]) . '</td>';
                    echo '<td>' . htmlspecialchars((string) $post_row["media_url"]) . '</td>';
                    echo '<td>';
                    echo '<a href="organizations_read?org_id=' . $org_row['org_id'] . '" class="mr-1" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                    echo '<a href="organizations_update.php?org_id=' . $org_row['org_id'] . '" class="mr-1" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                    echo '<a href="organizations_delete.php?org_id=' . $org_row['org_id'] . '" class="mr-1" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-danger"><em>No organizations found.</em></div>';
        }
        ?>
    </div>

    <?php
    Footer::render();
    ?>
</body>

</html>