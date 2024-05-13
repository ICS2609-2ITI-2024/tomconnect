<!DOCTYPE html>
<html lang="en">

<?php
require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

/*use Tomconnect\Components\Footer;
use Tomconnect\Components\Header;
use Tomconnect\Components\NavbarComponent;
use Tomconnect\Components\EventCard;


Header::render('tomconnect');
NavbarComponent::render();*/
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CS -->
    <link rel="stylesheet" href="./css/main.css">
    <title>Events</title>
</head>

<body>
    <div class="card main-card-style">
        <div class="card-body">
            <h6 class="card-title">Events</h6>
        </div>
        <div class="container-date">
            <select name="date" id="date">
                <option value="test">Any date</option>
            </select>
            <select name="time" id="time">
                <option value="test">Any time</option>
            </select>
        </div>
        <br>
        <div>
            <table>
                <tr>
                    <td>
                        <div class="container card card-style">
                            <h6 class="title-style">EVENT CARD SAMPLE</h6>
                        </div>
                    </td>
                    <td>
                        <div class="container card card-style">
                            <h6 class="title-style">EVENT CARD SAMPLE</h6>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="container card card-style">
                            <h6 class="title-style">EVENT CARD SAMPLE</h6>
                        </div>
                    </td>
                    <td>
                        <div class="container card card-style">
                            <h6 class="title-style">EVENT CARD SAMPLE</h6>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="container card card-style">
                            <h6 class="title-style">EVENT CARD SAMPLE</h6>
                        </div>
                    </td>
                    <td>
                        <div class="container card card-style">
                            <h6 class="title-style">EVENT CARD SAMPLE</h6>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="container card card-style">
                            <h6 class="title-style">EVENT CARD SAMPLE</h6>
                        </div>
                    </td>
                    <td>
                        <div class="container card card-style">
                            <h6 class="title-style">EVENT CARD SAMPLE</h6>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="container card card-style">
                            <h6 class="title-style">EVENT CARD SAMPLE</h6>
                        </div>
                    </td>
                    <td>
                        <div class="container card card-style">
                            <h6 class="title-style">EVENT CARD SAMPLE</h6>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="pagination">
            <a href="#">&laquo;</a>
            <a class="active" href="#">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a>
            <a href="#">&raquo;</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>