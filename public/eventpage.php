<!DOCTYPE html>
<html lang="en">

<?php
require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Components\EventCard;
use Tomconnect\Components\EventComponent;
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
    <div class="card main-card-style" style="width: 18rem;">
        <div class="card-body card-main-title">
            <h5 class="card-title">Events</h5>
        </div>
        <br>
        <div class="container-date">
            <select name="date" id="date">
                <option value="test">Any date</option>
            </select>
            <select name="time" id="time">
                <option value="test">Any time</option>
            </select>
        </div>
        <br>
        <table>
            <td>
                <div class="container container-event">
                    <div class="container card card-style">
                        <h3>EVENT CARD SAMPLE</h3>
                    </div>
            </td>
            <td>
                <div class="container container-event">
                    <div class="container card card-style">
                        <h3>EVENT CARD SAMPLE</h3>
                    </div>
            </td>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>