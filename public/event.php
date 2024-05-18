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
<!-- <div class="main-feed">
    <div class="left">
    </div> -->
    <main class="center">
        <h1>Coming Soon...</h1>
        <p>Get exclusive early access to our beta page by making a payment through GCash.</p>

        <!-- <div>
            <h6 class="title-card">Events</h6>
        </div>
        <div class="holder">
        </div> -->
        <?php
        // echo '<div class="events-container">';
        // foreach (EventModel::fetch_all() as $event) {
        //     echo '<div class="event-card">';
        //     EventCard::render(
        //         $event['description'],
        //         $event['location'],
        //         $event['link'],
        //         $event['event_start_date'],
        //         $event['event_end_date'],
        //         $event['event_time']
        //     );
        //     echo '</div>';
        // }
        // echo '</div>';
        ?>
    </main>
    <!-- <div class="right">
    </div> -->
</div>
<?php

Footer::render();
?>