<?php

namespace Tomconnect\Components;

use Tomconnect\Models\UserModel;

class OrganizationSearchCardComponent
{
    public static function render($organization_name, $profile_image_url, $user_id, $description)
    {
?>
        <div class="organization-search-card-component">
            <a href="" class="profile-picture">
                <img src=<?= ($profile_image_url != null) ? $profile_image_url : 'assets/IcBaselineAccountCircle.png' ?> alt="" class="profile-image">
            </a>
            <div class="author-container">
                <div class="author-name-and-date-published">
                    <h4 class="mb-0 nameStyle"><a href=""><?= ucwords($organization_name) ?></a></h4>
                    <h5><?= '@' . strtolower(UserModel::fetch($user_id)['username']) ?></h5>
                    <p><?= $description ?></p>
                </div>
            </div>
        </div>
<?php
    }
}
