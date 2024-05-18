<?php
declare(strict_types=1);

require_once (dirname(__DIR__)) . "/../vendor/autoload.php";

session_start();

use Tomconnect\Components\Header;
use Tomconnect\Components\Footer;
use Tomconnect\Models\OrganizationModel;

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



<?php
    Footer::render();
    ?>
</body>
</html>