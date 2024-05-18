<?php
declare(strict_types=1);

require_once(dirname(__DIR__)) . "/../vendor/autoload.php";

session_start();

use Tomconnect\Components\Header;
use Tomconnect\Components\Footer;
use Tomconnect\Models\OrganizationModel;

Header::render('Tomconnect Delete Record');

    // Prepare a delete statement
    $sql = "DELETE FROM tomconnect_db WHERE org_id = ?";

    if (isset($_GET["org_id"]) && !empty(trim($_GET["org_id"]))) {
        
        // Get the organization ID from the URL
        $org_id = trim($_GET["org_id"]);

        // Process form data when the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Attempt to delete the organization record
            if (OrganizationModel::delete((int)$org_id)) {
                // Redirect to the org dashboard page after successful deletion
                header("location: organizations_dashboard.php");
                exit();
            } else {
                // Display an error message if deletion fails
                echo "Error deleting the organization record.";
            }
        }
    } else {
        // Redirect to the error page if org_id is not provided in the URL
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
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?org_id=$org_id"); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="org_id" value="<?php echo $org_id; ?>" />
                            <p>Are you sure you want to delete this organization record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="organizations_dashboard.php" class="btn btn-secondary ml-2">No</a>
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
