<?php

namespace Tomconnect\Components;

session_start();

class CreatePostComponent
{
    public static function render()
    {
        if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) {
?>
<form action="../controllers/post.php" method="post" enctype="multipart/form-data">
    <textarea name="content" id="content"></textarea>
    <input type="file" name="upload" id="upload">
    <input type="submit" value="Post">
</form>
<?php
        }
    }
}
