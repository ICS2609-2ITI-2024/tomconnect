<?php


session_start();

if ($_SERVER['REQUEST_METHOD'] !== "POST")
{
    header("Location: " . "../public/404.php");
    die();
}

if (!isset($_SESSION['is_logged_in']))
{
    header("Location: " . "../public/404.php");
    die();
}

if (!isset($_SESSION['logged_user']))
{
    header("Location: " . "../public/404.php");
    die();
}

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Models\OrganizationModel;
use Tomconnect\Models\PostModel;
use Tomconnect\Utility\ImageUpload;

$logged_user = $_SESSION['logged_user'];

$data = [
    'author_id' => OrganizationModel::get_id($logged_user),
    'content' => $_POST['post_content']
];

$image_uploader = new ImageUpload($_FILES['img']);

echo $image_uploader->upload();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>User ID <?= OrganizationModel::get_id($logged_user) ?></h1>
    <article class="text" id='text'>
        <?= $data['content'] ?>
    </article>
</body>
</html>