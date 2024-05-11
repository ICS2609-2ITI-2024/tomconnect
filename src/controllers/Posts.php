<?php 

declare(strict_types=1);

namespace Tomconnect\controllers;

use Tomconnect\Models\PostModel;
use Tomconnect\Models\OrganizationModel;
use Tomconnect\Models\TagModel;

class Posts extends Controller
{
    private $posts = [];

    public function display()
    {
        $this->posts = PostModel::fetch_all(); // Fetch all posts
        $this->renderPosts();
    }

    private function renderPosts()
    {
        ob_start(); // Start output buffering to capture HTML output

        // Display posts
        foreach ($this->posts as $post) {
            ?>
            <div>
                <h2><?php echo $post['author_id']; ?></h2>
                <p><?php echo $post['content']; ?></p>
                <p>Media URL: <?php echo $post['media_url']; ?></p>
                <p>Created At: <?php echo $post['created_at']; ?></p>
                <p>Updated At: <?php echo $post['updated_at']; ?></p>
            </div>
            <?php
        }

        $html = ob_get_clean(); // Get the buffered HTML output and clean (clear) the buffer
        $this->view('posts/index', ['html' => $html]); // Pass the HTML to the view
    }
}

?>
