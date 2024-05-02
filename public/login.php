<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="../controllers/login.php" method="post">
        <label for="identifier">
            Username/Email
        </label>
        <input type="text" name="identifier" id="identifier">
        <label for="password">
            Password:
        </label>
        <input type="password" name="password" id="password">
        <input type="submit" value="Login">
    </form>
</body>
</html>