<!DOCTYPE html>
<html lang="en">

<?php
require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Components\CreatePostComponent;
use Tomconnect\Components\PostComponent;
use Tomconnect\Models\PostModel;
use Tomconnect\Models\OrganizationModel;
use Tomconnect\Components\Footer;
use Tomconnect\Components\Header;
use Tomconnect\Components\NavbarComponent;
use Tomconnect\Components\EventCard;
use Tomconnect\Models\EventModel;

Header::render('tomconnect');
NavbarComponent::render();
?>


<img src="./assets/ust_landscape.png" alt="" class="back-img">
<div class="main-feed">
    <div class="left">
    </div>
    <main class="main">
        <div>
            <h6 class="title-card">Events</h6>
        </div>
        <div class="date-container">
            <select name="date" id="date">
                <option value="test">Any date</option>
            </select>
            <select name="time" id="time">
                <option value="test">Any time</option>
            </select>
        </div>
        <?php
        echo '<div class="events-container">';
        foreach (EventModel::fetch_all() as $event) {
            echo '<div class="event-card">';
            $author = EventModel::fetch($event['event_id']);
            EventCard::render($event['description'], $event['location'], $event['link']);
            echo '</div>';
        }
        echo '</div>';
        ?>
    </main>
    <div class="right">
    </div>
</div>

<?php

Footer::render();
?>