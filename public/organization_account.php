<?php

declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomConnect</title>
    <link rel="stylesheet" href="../public/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php

    use Tomconnect\Controllers\Post;
    use Tomconnect\Models\PostModel;
    use Tomconnect\Utility\ImageUpload; //for Org Cover Photo?

    //import header and footer

    /** 
     * Container for Organization's Cover Photo
     */
    class CoverPhoto
    {
        private $coverPhoto;
        private $coverPhotoAlt;

        public function __construct($coverPhoto, $coverPhotoAlt)
        {
            $this->coverPhoto = $coverPhoto;
            $this->coverPhotoAlt = $coverPhotoAlt;
        }

        public function displayCoverPhoto()
        {
            echo "<img src='$this->coverPhoto' alt='$this->coverPhotoAlt'>";
        }
    }

    /** 
     * Container for Organization's Profile Photo
     */
    class ProfilePhoto
    {
        private $profilePhoto;
        private $profilePhotoAlt;

        public function __construct($profilePhoto, $profilePhotoAlt)
        {
            $this->profilePhoto = $profilePhoto;
            $this->profilePhotoAlt = $profilePhotoAlt;
        }

        public function displayProfile()
        {
            echo "<img src='$this->profilePhoto' alt='$this->profilePhotoAlt'>";
        }
    }

    /** 
     * Handler of "About" Section
     */
    class About
    {
        private $about;

        public function __construct($about)
        {
            $this->about = $about;
        }

        public function displayAbout()
        {
            echo "<h1> About </h1>";
            echo "<p>$this->about</p>";
        }
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                $coverPhoto = new CoverPhoto("path/to/cover/photo", "Cover Photo");
                $coverPhoto->displayCoverPhoto();
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <?php
                $profilePhoto = new ProfilePhoto("path/to/profile/photo", "Profile Photo");
                $profilePhoto->displayProfile();
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <?php
                echo "<h1> About </h1>";
                $about = new About("This is a description of the organization.");
                $about->displayAbout();
                ?>

                <h1> Posts </h1>
                <?php
                $post = new Post();
                $post->post(1);
                ?>

            </div>

            <div class="row">

            </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</html>