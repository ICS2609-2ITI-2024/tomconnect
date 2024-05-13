<?php

namespace Tomconnect\Components;

session_start();

class CreatePostComponent
{
    public static function render()
    {
        if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) {
?>
            <form action="../controllers/post.php" method="post" enctype="multipart/form-data" class="post-form">
                <div class="content">
                    <div class="other">
                        <textarea name="content" id="content" placeholder="Share updates, events, news, or any current activities within your organization..."></textarea>
                    </div>
                    <div class="buttons">
                        <input type="file" name="upload" id="upload">
                        <input type="submit" value="Post">
                    </div>
                </div>
            </form>
<?php
        }
    }
}
