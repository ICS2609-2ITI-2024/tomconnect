<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomConnect</title>
    <link rel="shortcut icon" type="image/x-icon" href="../public/assets/logo.ico">
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>

    <!-- ORG LOGIN PAGE -->
    <form action="../controllers/login.php" method="post">

    <div class="login-container">
        <img src="./assets/logo.png" alt="" class="logo-login">
        <h1 class="login-text"> Welcome Back! </h1>

        <div class="login-field">
            <img src="./assets/user.png" alt="" class="login-icon" ></img>
            <input type="text" name="identifier" placeholder="Username/Email" class="login-input">
        </div>

        <br>

        <div class="login-field">
            <img src="./assets/lock.png" alt="" class="login-icon" ></img>
            <input type="password" name="password" placeholder="Password" class="login-input">
        </div>

        <input type="submit" value="LOG IN" class="login-button">

    </div>
    </form>
    <img src="./assets/admin_background.png" alt="" class="login-background">

</body>

</html>