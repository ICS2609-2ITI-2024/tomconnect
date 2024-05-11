<?php

declare(strict_types=1);

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";


session_start();

// if (!isset($_SESSION['is_logged_in'])) {
//     header("Location: " . "login.php");
//     die();
// }

use Components\OrganizationCard;
use Tomconnect\Models\OrganizationModel;
use Tomconnect\Components\Footer;
use Tomconnect\Components\Header;


Header::render('tomconnect');

Footer::render();
?>