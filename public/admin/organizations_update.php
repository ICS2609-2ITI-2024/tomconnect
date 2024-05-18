<?php
declare(strict_types=1);

require_once(dirname(__DIR__)) . "/../vendor/autoload.php";

session_start();

use Tomconnect\Components\Header;
use Tomconnect\Components\Footer;
use Tomconnect\Models\OrganizationModel;

Header::render('Tomconnect Update Organization');

// Define variables and initialize with empty values
$name = $description = $admin_id = $website = $logo_url = $location = $registration_url = $cover_img_url = "";
$name_err = $description_err = $admin_id_err = $website_err = $logo_url_err = $location_err = $registration_url_err = $cover_img_url_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["org_id"]) && !empty($_POST["org_id"])) {
    // Get hidden input value
    $org_id = $_POST["org_id"];

    // Validate Name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } else {
        $name = $input_name;
    }

    // Validate Description
    $input_description = trim($_POST["description"]);
    if (empty($input_description)) {
        $description_err = "Please enter a description.";
    } else {
        $description = $input_description;
    }

    // Validate Admin ID
    $input_admin_id = trim($_POST["admin_id"]);
    if (empty($input_admin_id)) {
        $admin_id_err = "Please enter an admin ID.";
    } else {
        $admin_id = $input_admin_id;
    }

    // Validate Website
    $input_website = trim($_POST["website"]);
    if (empty($input_website)) {
        $website_err = "Please enter a website.";
    } else {
        $website = $input_website;
    }

    // Validate Logo URL
    $input_logo_url = trim($_POST["logo_url"]);
    if (empty($input_logo_url)) {
        $logo_url_err = "Please enter a logo URL.";
    } else {
        $logo_url = $input_logo_url;
    }

    // Validate Location
    $input_location = trim($_POST["location"]);
    if (empty($input_location)) {
        $location_err = "Please enter a location.";
    } else {
        $location = $input_location;
    }

    // Validate Registration URL
    $input_registration_url = trim($_POST["registration_url"]);
    if (empty($input_registration_url)) {
        $registration_url_err = "Please enter a registration URL.";
    } else {
        $registration_url = $input_registration_url;
    }

    // Validate Cover Image URL
    $input_cover_img_url = trim($_POST["cover_img_url"]);
    if (empty($input_cover_img_url)) {
        $cover_img_url_err = "Please enter a cover image URL.";
    } else {
        $cover_img_url = $input_cover_img_url;
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($description_err) && empty($admin_id_err) && empty($website_err) && empty($logo_url_err) && empty($location_err) && empty($registration_url_err) && empty($cover_img_url_err)) {
        // Prepare data array
        $data = [
            'name' => $name,
            'description' => $description,
            'admin_id' => $admin_id,
            'website' => $website,
            'logo_url' => $logo_url,
            'location' => $location,
            'registration_url' => $registration_url,
            'cover_img_url' => $cover_img_url
        ];

        // Update the organization using the model
        OrganizationModel::update($org_id, $data);

        // Records updated successfully. Redirect to landing page
        header("location: organizations_dashboard.php");
        exit();
    }
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["org_id"]) && !empty(trim($_GET["org_id"]))) {
        // Get URL parameter
        $org_id = trim($_GET["org_id"]);

        // Fetch the organization data
        $organization = OrganizationModel::fetch((int)$org_id);

        if ($organization) {
            // Retrieve individual field value
            $name = $organization["name"];
            $description = $organization["description"];
            $admin_id = $organization["admin_id"];
            $website = $organization["website"];
            $logo_url = $organization["logo_url"];
            $location = $organization["location"];
            $registration_url = $organization["registration_url"];
            $cover_img_url = $organization["cover_img_url"];
        } else {
            // URL doesn't contain valid id. Redirect to error page
            header("location: error.php");
            exit();
        }
    } else {
        // URL doesn't contain id parameter. Redirect to error page
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
                    <h2 class="mt-5 crud-title">Update Organization</h2>
                    <p>Please edit the input values and submit to update the organization record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="update-container">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Admin ID</label>
                            <input type="text" name="admin_id" class="form-control <?php echo (!empty($admin_id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $admin_id; ?>">
                            <span class="invalid-feedback"><?php echo $admin_id_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Website</label>
                            <input type="text" name="website" class="form-control <?php echo (!empty($website_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $website; ?>">
                            <span class="invalid-feedback"><?php echo $website_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Logo URL</label>
                            <input type="text" name="logo_url" class="form-control <?php echo (!empty($logo_url_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $logo_url; ?>">
                            <span class="invalid-feedback"><?php echo $logo_url_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" class="form-control <?php echo (!empty($location_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $location; ?>">
                            <span class="invalid-feedback"><?php echo $location_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Registration URL</label>
                            <input type="text" name="registration_url" class="form-control <?php echo (!empty($registration_url_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $registration_url; ?>">
                            <span class="invalid-feedback"><?php echo $registration_url_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Cover Image URL</label>
                            <input type="text" name="cover_img_url" class="form-control <?php echo (!empty($cover_img_url_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cover_img_url; ?>">
                            <span class="invalid-feedback"><?php echo $cover_img_url_err; ?></span>
                        </div>

                        <input type="hidden" name="org_id" value="<?php echo $org_id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br>
    <br>

</body>

</html>

<?php Footer::render(); ?>
