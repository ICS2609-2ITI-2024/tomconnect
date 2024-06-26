<?php

namespace Tomconnect\Components;

class EventCard
{
    public static function render($event_title, $event_location, $register_link, $event_start_date, $event_end_date, $event_time)
    {
?>
        <div class="event-card">
            <div class="event-container">
                <div class="event-date"><?= date('D, F j', strtotime($event_start_date)) ?> AT <?= date('g:i A', strtotime($event_time)) ?></div>
                <div class="event-title"><?= ucwords($event_title) ?></div>
                <div class="event-location">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                        <path d="M6.5 0.8125C5.31525 0.813898 4.17942 1.28516 3.34166 2.12291C2.50391 2.96066 2.03265 4.09649 2.03125 5.28125C2.02984 6.24943 2.34609 7.19135 2.9315 7.9625C2.9315 7.9625 3.05338 8.12297 3.07329 8.14612L6.5 12.1875L9.92835 8.14409C9.94622 8.12256 10.0685 7.9625 10.0685 7.9625L10.0689 7.96128C10.654 7.19047 10.9701 6.24899 10.9688 5.28125C10.9674 4.09649 10.4961 2.96066 9.65834 2.12291C8.82059 1.28516 7.68476 0.813898 6.5 0.8125ZM6.5 6.90625C6.17861 6.90625 5.86443 6.81095 5.5972 6.63239C5.32997 6.45383 5.12169 6.20004 4.9987 5.90311C4.87571 5.60618 4.84353 5.27945 4.90623 4.96423C4.96893 4.64901 5.1237 4.35946 5.35096 4.1322C5.57822 3.90494 5.86776 3.75017 6.18298 3.68747C6.4982 3.62477 6.82493 3.65695 7.12186 3.77995C7.4188 3.90294 7.67259 4.11122 7.85114 4.37845C8.0297 4.64568 8.125 4.95986 8.125 5.28125C8.12447 5.71206 7.95309 6.12507 7.64846 6.4297C7.34383 6.73433 6.93082 6.90571 6.5 6.90625Z" fill="black" />
                    </svg>
                    <p><?= $event_location ?></p>
                </div>
                <div>
                    <a href=<?= $register_link ?> class="event-reg-button">
                        REGISTER
                    </a>
                </div>
            </div>
        </div>
<?php
    }
}
