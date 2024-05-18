<?php

declare(strict_types=1);

require_once (dirname(__DIR__)) . "/../vendor/autoload.php";

session_start();

use Tomconnect\Components\Header;
use Tomconnect\Components\Footer;
use Tomconnect\Models\EventModel;

Header::render('Tomconnect Delete Record');

if (isset($_GET["event_id"]) && !empty(trim($_GET["event_id"]))) {
    $event_id = trim($_GET["event_id"]);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!EventModel::delete((int)$event_id)) {
            header("location: event_dashboard.php");
            exit();
        } else {
            echo "Error deleting the event record.";
        }
    }
} else {
    header("location: error.php");
    exit();
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
                    <h2 class="mt-5 mb-4 crud-title">Delete Record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?event_id=$event_id"); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="org_id" value="<?php echo $org_id; ?>" />
                            <p>Are you sure you want to delete this event record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="event_dashboard.php" class="btn btn-secondary ml-2">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php Footer::render(); ?>
</body>

</html>