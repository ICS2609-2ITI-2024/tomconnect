<?php

declare(strict_types=1);

require_once dirname(__DIR__) . "/../vendor/autoload.php";

session_start();

use Tomconnect\Components\Header;
use Tomconnect\Components\Footer;
use Tomconnect\Models\EventModel;

Header::render('Tomconnect Update Event');

$name = $post_id = $description = $event_start_date = $event_end_date = $event_time = $link = $location = $is_deleted = "";
$name_err = $post_id_err = $description_err = $event_start_date_err = $event_end_date_err = $event_time_err = $link_err = $location_err = $is_deleted_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["event_id"]) && !empty($_POST["event_id"])) {
    $event_id = $_POST["event_id"];

    $input_post_id = trim($_POST["post_id"]);
    if (empty($input_post_id)) {
        $post_id_err = "Please enter a Post ID.";
    } else {
        $post_id = $input_post_id;
    }

    $input_description = trim($_POST["description"]);
    if (empty($input_description)) {
        $description_err = "Please enter a Description.";
    } else {
        $description = $input_description;
    }

    $input_event_start_date = trim($_POST["event_start_date"]);
    if (empty($input_event_start_date)) {
        $event_start_date_err = "Please enter a Date.";
    } else {
        $event_start_date = $input_event_start_date;
    }

    $input_event_end_date = trim($_POST["event_end_date"]);
    if (empty($input_event_end_date)) {
        $event_end_date_err = "Please enter a Date.";
    } else {
        $event_end_date = $input_event_end_date;
    }

    $input_event_time = trim($_POST["event_time"]);
    if (empty($input_event_time)) {
        $event_time_err = "Please enter a Time.";
    } else {
        $event_time = $input_event_time;
    }

    $input_link = trim($_POST["link"]);
    if (empty($input_link)) {
        $link_err = "Please enter a Link.";
    } else {
        $link = $input_link;
    }

    $input_location = trim($_POST["location"]);
    if (empty($input_location)) {
        $location_err = "Please enter a location.";
    } else {
        $location = $input_location;
    }

    $input_is_deleted = trim($_POST["is_deleted"]);
    if ($input_is_deleted === "") {
        $is_deleted_err = "Please enter a valid status.";
    } else {
        $is_deleted = $input_is_deleted;
    }

    if (empty($post_id_err) && empty($description_err) && empty($event_start_date_err) && empty($event_end_date_err) && empty($event_time_err) && empty($link_err) && empty($location_err) && empty($is_deleted_err)) {
        $data = [
            'post_id' => $post_id,
            'description' => $description,
            'event_start_date' => $event_start_date,
            'event_end_date' => $event_end_date,
            'event_time' => $event_time,
            'link' => $link,
            'location' => $location,
            'is_deleted' => $is_deleted,
        ];

        EventModel::update((int)$event_id, $data);

        // Redirect to event_dashboard.php after successful update
        header("Location: event_dashboard.php");
        exit();
    }
} else {
    if (isset($_GET["event_id"]) && !empty(trim($_GET["event_id"]))) {
        $event_id = trim($_GET["event_id"]);
        $event = EventModel::fetch((int)$event_id);

        if ($event) {
            $post_id = $event["post_id"];
            $description = $event["description"];
            $event_start_date = $event["event_start_date"];
            $event_end_date = $event["event_end_date"];
            $event_time = $event["event_time"];
            $link = $event["link"];
            $location = $event["location"];
            $is_deleted = $event["is_deleted"];
        } else {
            header("location: error.php");
            exit();
        }
    } else {
        header("location: error.php");
        exit();
    }
}
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
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 crud-title">Update Event</h2>
                    <p>Please edit the input values and submit to update the event record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="update-container">
                            <div class="form-group">
                                <label>Post ID</label>
                                <input type="text" name="post_id" class="form-control <?php echo (!empty($post_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $post_id; ?>">
                                <span class="invalid-feedback"><?php echo $post_id_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                                <span class="invalid-feedback"><?php echo $description_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
                                <input type="date" name="event_start_date" class="form-control <?php echo (!empty($event_start_date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $event_start_date; ?>">
                                <span class="invalid-feedback"><?php echo $event_start_date_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input type="date" name="event_end_date" class="form-control <?php echo (!empty($event_end_date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $event_end_date; ?>">
                                <span class="invalid-feedback"><?php echo $event_end_date_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Time</label>
                                <input type="time" name="event_time" class="form-control <?php echo (!empty($event_time_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $event_time; ?>">
                                <span class="invalid-feedback"><?php echo $event_time_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input type="text" name="link" class="form-control <?php echo (!empty($link_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $link; ?>">
                                <span class="invalid-feedback"><?php echo $link_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" name="location" class="form-control <?php echo (!empty($location_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $location; ?>">
                                <span class="invalid-feedback"><?php echo $location_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label>Is Deleted</label>
                                <input type="text" name="is_deleted" class="form-control <?php echo (!empty($is_deleted_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $is_deleted; ?>">
                                <span class="invalid-feedback"><?php echo $is_deleted_err; ?></span>
                            </div>
                            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>" />
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="event_dashboard.php" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php Footer::render(); ?>
</body>

</html>