<!DOCTYPE html>
<html lang="en">

<?php
require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Components\Footer;
use Tomconnect\Components\Header;
use Tomconnect\Components\NavbarComponent;
use Tomconnect\Components\EventCard;
use Tomconnect\Models\EventModel;

Header::render('tomconnect');
NavbarComponent::render();

?>
<img src="./assets/ust_landscape.png" alt="" class="back-img">
<div class="main-card-style">
    <div>
        <h6 class="card-title">Events</h6>
    </div>
    <div>
        <select name="date" id="date">
            <option value="test">Any date</option>
        </select>
        <select name="time" id="time">
            <option value="test">Any time</option>
        </select>
    </div>
    <div>
        <table>
            <tr>
                <td>
                    <?php
                    $event1 = EventModel::fetch(1);
                    EventCard::render($event1['description'], $event1['location'], $event1['link']); ?>
                </td>
                <td>
                    <?php
                    $event2 = EventModel::fetch(2);
                    EventCard::render($event2['description'], $event2['location'], $event2['link']); ?>
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
    <?php

    Footer::render();
    ?>