<?php

namespace Tomconnect\Components;

class PostComponent
{

    public static function render($author_name, $profile_image_url, $content, $media_url, $date_published)
    {
?>
        <article class="post-card">
            <div class="card cardCustom">
                <div class="author-container">
                    <a href="">
                        <img src=<?= ($profile_image_url != null) ? $profile_image_url : 'assets/IcBaselineAccountCircle.png' ?> alt="" class="profile-image">
                    </a>
                    <div class="author-name-and-date-published">
                        <h4 class="mb-0 nameStyle"><a href=""><?= ucwords($author_name) ?></a></h4>
                        <small><?= self::timeAgo(strtotime($date_published)) ?></small>
                    </div>
                </div>
                <div class="content-container">
                    <pre class="content linkify"><?= htmlspecialchars(trim($content)) ?></pre>
                    <!-- <div class="container container-fluid">
                        <div class="tag">
                            <span>University-Wide</span>
                        </div>
                    </div> -->
                </div>
                <?php if ($media_url != null) : ?>
                    <div class="mainImageContainer">
                        <img src=<?= $media_url ?> class="card-img-top img-fluid mainImage" alt="...">
                    </div>
                <?php endif ?>
            </div>
        </article>
<?php
    }

    private static function timeAgo($timestamp)
    {
        $current_time = time();
        $time_diff = $current_time - $timestamp;

        // Define time intervals in seconds
        $seconds_in_a_minute = 60;
        $seconds_in_an_hour = 3600; // 60 * 60
        $seconds_in_a_day = 86400; // 60 * 60 * 24
        $seconds_in_a_week = 604800; // 60 * 60 * 24 * 7

        if ($time_diff < $seconds_in_a_minute) {
            return 'just now';
        } elseif ($time_diff < $seconds_in_an_hour) {
            $seconds = floor($time_diff);
            return $seconds . ' seconds ago';
        } elseif ($time_diff < $seconds_in_a_day) {
            $hours = floor($time_diff / $seconds_in_an_hour);
            return $hours . ' hours ago';
        } elseif ($time_diff < $seconds_in_a_week) {
            $days = floor($time_diff / $seconds_in_a_day);
            return $days . ' days ago';
        } else {
            $weeks = floor($time_diff / $seconds_in_a_week);
            if ($weeks == 1) {
                return $weeks . ' week ago';
            } else {
                return $weeks . ' weeks ago';
            }
        }
    }
}
