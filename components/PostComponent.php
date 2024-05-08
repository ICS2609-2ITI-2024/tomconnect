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
                    <img src=<?= $profile_image_url ?> alt="" class="profile-image">
                    <div class="author-name-and-date-published">
                        <h6 class="mb-0 nameStyle"><?= ucwords($author_name) ?></h6>
                        <small><?= self::timeAgo(strtotime($date_published)) ?></small>
                    </div>
                </div>
                <div class="mainImageContainer">
                    <img src=<?= $media_url ?> class="card-img-top img-fluid mainImage" alt="...">
                </div>
                <div class="content-container">
                    <p class="content">
                        <?= $content ?>
                    </p>
                    <div class="container container-fluid">
                        <div class="tag">
                            <span>University-Wide</span>
                        </div>
                    </div>
                </div>
            </div>
        </article>
<?php
    }

    private static function timeAgo($timestamp)
    {
        $current_time = time();
        $time_diff = $current_time - $timestamp;
        $seconds_in_a_day = 86400; // 60 * 60 * 24
        $seconds_in_a_week = 604800; // 60 * 60 * 24 * 7

        if ($time_diff < $seconds_in_a_day) {
            return '1 day ago';
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
