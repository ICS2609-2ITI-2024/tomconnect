<?php

declare(strict_types=1);

require_once (dirname(__DIR__)) . "/../vendor/autoload.php";

session_start();

use Tomconnect\Components\Header;
use Tomconnect\Components\Footer;
use Tomconnect\Models\EventModel;

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

    <div class="event-container">
        <h1 class="dashboard-title">Read Table</h1>
        <br>

        <?php
        $full_events = EventModel::fetch_all();
        if (!empty($full_events)) {
            echo '<table class="table table-bordered table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Event ID</th>';
            echo '<th>Post ID</th>';
            echo '<th>Description</th>';
            echo '<th>Event Start</th>';
            echo '<th>Event End</th>';
            echo '<th>Event Time</th>';
            echo '<th>Link</th>';
            echo '<th>Location</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($full_events as $row) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars((string) $row["event_id"]) . '</td>';
                echo '<td>' . htmlspecialchars((string) $row["post_id"]) . '</td>';
                echo '<td>' . htmlspecialchars((string) $row["description"]) . '</td>';
                echo '<td>' . htmlspecialchars((string) $row["event_start_date"]) . '</td>';
                echo '<td>' . htmlspecialchars((string) $row["event_end_date"]) . '</td>';
                echo '<td>' . htmlspecialchars((string) $row["event_time"]) . '</td>';
                echo '<td>' . htmlspecialchars((string) $row["link"]) . '</td>';
                echo '<td>' . htmlspecialchars((string) $row["location"]) . '</td>';
                echo "<td>";
                echo '<a href="event_read?event_id=' . $row['event_id'] . '" class="mr-1" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';

                echo '<a href="event_update.php?event_id=' . $row['event_id'] . '" class="mr-1" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';

                echo '<a href="event_delete.php?event_id=' . $row['event_id'] . '" class="mr-1" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                echo "</td>";
                echo "</tr>";
                echo '</tr>';
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