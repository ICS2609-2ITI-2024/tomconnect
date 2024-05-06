<?php
declare(strict_types=1);

namespace Tomconnect\Controllers;

use Tomconnect\Utility\ImageUpload;
use Tomconnect\Models\PostModel;

class Post
{

    private $content;

    private $image_upload;

    private $author_id;

    private $image_url;


    public function post($author_id)
    {
        $this->author_id = $author_id;
        $this->content = $_POST['content'];

        if ($this->is_content_empty()) {
            return false;
        }

        if ($this->is_file_empty()) {
            return false;
        }


        $this->image_upload = new ImageUpload($_FILES['upload']);
        $this->image_url = $this->image_upload->upload();

        $this->store_post_to_db();
        return true;
    }

    private function store_post_to_db()
    {
        PostModel::create(['author_id' => $this->author_id, 'content' => $this->content]);
        $post_id = PostModel::search_from_column('content', $this->content)[0]['post_id'];
        PostModel::update($post_id, ['media_url' => $this->image_url]);
    }

    private function is_content_empty()
    {
        return (!isset($_POST['content']) || empty($_POST['content']));
    }

    private function is_file_empty()
    {
        return (!isset($_FILES['upload']));
    }

}