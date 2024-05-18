<?php

declare(strict_types=1);

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();

use Tomconnect\Components\Header;
use Tomconnect\Components\Footer;

Header::render('Tomconnect Sign Up');
?>
<form action="../controllers/signup.php" method="post">
    <div class="">
        <input type="text" name="username" id="">
        <span>
            <?php if (isset($_SESSION['username_error_message'])) {
                echo $_SESSION['username_error_message'];
                unset($_SESSION['username_error_message']);
            }
            ?>
        </span>
    </div>
    <div class="">
        <input type="email" name="email" id="">
        <span>
            <?php if (isset($_SESSION['email_error_message'])) {
                echo $_SESSION['email_error_message'];
                unset($_SESSION['email_error_message']);
            }
            ?>
        </span>
    </div>
    <div class="">
        <input type="password" name="password" id="">
        <span>
            <?php if (isset($_SESSION['password_error_message'])) {
                echo $_SESSION['password_error_message'];
                unset($_SESSION['password_error_message']);
            }
            ?>
        </span>
    </div>
    <div class="">
        <input type="password" name="confirm_password" id="">
        <span>
            <?php if (isset($_SESSION['confirm_password_error_message'])) {
                echo $_SESSION['confirm_password_error_message'];
                unset($_SESSION['confirm_password_error_message']);
            }
            ?>
        </span>
    </div>
    <div class="">
        <input type="text" name="organization_name" id="">
        <span>
            <?php if (isset($_SESSION['organization_name_error_message'])) {
                echo $_SESSION['organization_name_error_message'];
                unset($_SESSION['organization_name_error_message']);
            }
            ?>
        </span>
    </div>
    <div class="">
        <textarea name="organization_description" id=""></textarea>
        <span>
            <?php if (isset($_SESSION['organization_description_error_message'])) {
                echo $_SESSION['organization_description_error_message'];
                unset($_SESSION['organization_description_error_message']);
            }
            ?>
        </span>
    </div>
    <input type="submit" value="Signup">
</form>
<?php
Footer::render();
?>