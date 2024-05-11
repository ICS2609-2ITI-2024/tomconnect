<?php

namespace Tomconnect\Utility;

class ImageUpload
{
    // const FILE_PATH = ;

    const ALLOWED_TYPE = ['jpg', 'jpeg', 'png', 'gif', 'tiff', 'tif'];
    
    const FILE_PATH = "img/";
    private $file_name;

    private $file_type;

    private $file_tmp_name;

    private $file_error;

    private $file_size;

    private $file_extension;

    private $file_actual_extension; 
    private $file_destination;

    private $file_path;


    function __construct($image)
    {
        $this->file_name = $image['name'];
        $this->file_type = $image['type'];
        $this->file_tmp_name = $image['tmp_name'];
        $this->file_error = $image['error'];
        $this->file_size = $image['size'];
        $this->file_extension = explode('.', $this->file_name);
        $this->file_actual_extension = strtolower(end($this->file_extension));
    }

    public function upload()
    {
        if (!$this->is_file_extension_valid()) {
            return -1;
        }

        if ($this->error_check()) {
            return -1;
        }

        if (!$this->is_file_size_valid()) {
            return -1;
        }

        $new_file_name = $this->generate_new_file_name();
        $this->set_file_destination($this->generate_file_destination($new_file_name));
        $this->move_file();
        return self::FILE_PATH . $new_file_name;
    }

    private function is_file_extension_valid()
    {
        return in_array($this->file_actual_extension, self::ALLOWED_TYPE);
    }

    private function error_check()
    {
        return $this->file_error !== 0;
    }

    private function is_file_size_valid()
    {
        return $this->file_size < 500000;
    }

    private function generate_new_file_name()
    {
        return uniqid('', true) . '.' . $this->file_actual_extension;
    }

    private function generate_file_destination($filename)
    {
        return dirname(dirname(__DIR__)) . "\\public\\img\\" . $filename;
    }

    private function move_file()
    {
        move_uploaded_file($this->file_tmp_name, $this->file_destination);
    }

    private function set_file_destination($file_destination)
    {
        $this->file_destination = $file_destination;
    }
}