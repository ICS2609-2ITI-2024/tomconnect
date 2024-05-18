<?php

declare(strict_types=1);

session_start();

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TomConnect</title>
    <link rel="shortcut icon" type="image/x-icon" href="../public/assets/logo.ico">

    <link rel="stylesheet" href="./css/main.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php
    use Tomconnect\Components\CreatePostComponent;
    use Tomconnect\Components\PostComponent;
    use Tomconnect\Components\Footer;
    use Tomconnect\Components\Header;
    use Tomconnect\Components\NavbarComponent;

    use Tomconnect\Controllers\Post;

    use Tomconnect\Models\PostModel;
    use Tomconnect\Models\OrganizationModel;

    use Tomconnect\Utility\ImageUpload; //for Org Cover Photo?

    Header::render('tomconnect');
    NavbarComponent::render();

/** 
     * Container for Organization's Cover Photo
     * retrieve cover_img_url from organizations database
     */
    class CoverPhoto
    {
        public static function render($image_url, $org_id)
        {
    ?>

    <!--replace img src with "< ?php echo $image_url ?>" -->
            <div class="card org_coverphoto">
                <img src="./assets/admin_background.png" class="card-img-bottom" alt="..." id="<?= $org_id ?>">
            </div>

        <?php
        }
    }

    /** 
     * Container for Organization's Profile Photo
     * retrieve logo_url from organizations database
     */
    class ProfilePhoto
    {
        public static function render($logo_url, $org_id)
        {
        ?>
            <div class="card">
                <img src="<?php echo $logo_url ?>" class="card-img-top" alt="..." id="<?= $org_id ?>">
            </div>
    <?php
        }
    }


    /** 
     *  "About" Section
     * retrieve description from organizations database
     */

    $org = OrganizationModel::fetch(3);
    ?>

    <!-- Front End for Organization Account -->
    <!-- Cover Photo -->
    <div class="container">

        <div class="row">
            <div class="col-12">
                <?php
                    CoverPhoto::render($org['cover_img_url'], $org['org_id']);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <?php
                ProfilePhoto::render($org['cover_img_url'], $org['org_id']);
                ?>
            </div>
        </div>

        <!-- row of quick org info and about -->
        <div class="row">
            <div class="col-4">
                <div class="col"> <!--col for icons-->
                    <div class="row icon-info">
                        <img src="./assets/Location.png" alt="Location Icon">
                        <h2 class="orgInfo-title"> Location </h2>
                        <?php 
                            echo $org['location'];
                            ?> </p>
                    </div>

                    <div class="row icon-info">
                        <img src="./assets/Email.png" alt="Email Icon">
                    </div>

                    <div class="row icon-info">
                        <img src="./assets/Website.png" alt="Website Icon">
                    </div>

                </div>

                <div class="col"> <!--col for information-->
                    <!--Retrieve Org's Location-->
                    <div class="row">

                    </div>

                    <!--Retrieve Org's Contact Email-->
                    <div class="row">
                        <h2 class="orgInfo-title"> Contact Us </h2>
                        <?php 
                            echo $org['location'];
                            ?> </p>
                    </div>

                    <!--Retrieve Org's Website-->


                    <!--Add Line // Separator-->

                    <!--Indicator if Org Registration is Open or Closed-->

                    <!--Org Registration Button-->

                </div>
            </div>

            <div class="col-8">
                <!-- row of posts // last row-->
                <div class="row justify-content-center white-container">
                    <div class="about-container">
                        <h1 class="orgTitle"> About </h1>
                        <p> <?php 
                            $org = OrganizationModel::fetch(3);
                            echo $org['description'];
                            ?> </p>
                    </div>

                    <div class="posts-container">
                        <h1 class="orgTitle">  Posts </h1>
                            <?php
                            CreatePostComponent::render();
                            foreach (PostModel::fetch_all() as $post) {
                                $author = OrganizationModel::fetch($post['author_id']);
                                PostComponent::render($author['name'], $author['logo_url'], $post['content'], $post['media_url'], $post['created_at']);
                            }
                            ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
            <?php
            Footer::render();
            ?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>