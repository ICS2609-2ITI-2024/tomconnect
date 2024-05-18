<?php

declare(strict_types=1);

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

session_start();

use Tomconnect\Components\Header;
use Tomconnect\Components\Footer;

Header::render('Tomconnect Sign Up');
?>
<link rel="stylesheet" href="./css/main.css">

<img src="./assets/ust_landscape.png" alt="" class="back-img">

<div class="form-container">
    <form action="../controllers/signup.php" method="post">
        <div class="signup-container">
            <h1 class="signup-title">Sign Up</h1>

            <div class="form-group">
                <h3> Enter your Username </h3>
                <input type="text" name="username" id="">
                <span>
                    <?php if (isset($_SESSION['username_error_message'])) {
                        echo $_SESSION['username_error_message'];
                        unset($_SESSION['username_error_message']);
                    }
                    ?>
                </span>
            </div>
            <br>

            <div class="form-group">
                <h3> Enter your Organization's Email </h3>
                <input type="email" name="email" id="">
                <span>
                    <?php if (isset($_SESSION['email_error_message'])) {
                        echo $_SESSION['email_error_message'];
                        unset($_SESSION['email_error_message']);
                    }
                    ?>
                </span>
            </div>
            <br>

            <div class="form-group">
                <h3> Enter your Password </h3>
                <input type="password" name="password" id="">
                <span>
                    <?php if (isset($_SESSION['password_error_message'])) {
                        echo $_SESSION['password_error_message'];
                        unset($_SESSION['password_error_message']);
                    }
                    ?>
                </span>
            </div>
            <br>

            <div class="form-group">
                <h3> Confirm your Password </h3>
                <input type="password" name="confirm_password" id="">
                <span>
                    <?php if (isset($_SESSION['confirm_password_error_message'])) {
                        echo $_SESSION['confirm_password_error_message'];
                        unset($_SESSION['confirm_password_error_message']);
                    }
                    ?>
                </span>
            </div>
            <br>

            <div class="form-group">
                <h3> Enter your Organization's Name </h3>
                <input type="text" name="organization_name" id="">
                <span>
                    <?php if (isset($_SESSION['organization_name_error_message'])) {
                        echo $_SESSION['organization_name_error_message'];
                        unset($_SESSION['organization_name_error_message']);
                    }
                    ?>
                </span>
            </div>
            <br>

            <div class="form-group">
                <h3> Enter your Organization's Description </h3>
                <textarea name="organization_description" id=""></textarea>
                <span>
                    <?php if (isset($_SESSION['organization_description_error_message'])) {
                        echo $_SESSION['organization_description_error_message'];
                        unset($_SESSION['organization_description_error_message']);
                    }
                    ?>
                </span>
            </div>
            <br>
            
            <input type="submit" value="Signup">
        </div>
    </form>
</div>

<?php
Footer::render();
?>
