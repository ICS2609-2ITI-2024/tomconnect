<?php

session_start();

unset($_SESSION['is_logged_in']);
unset($_SESSION['logged_user']);
unset($_SESSION['logged_id']);

header("Location: " . "../public/index.php");
die();