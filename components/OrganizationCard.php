<?php

namespace Tomconnect\Components;

class OrganizationCard
{
    public function render($org_id, $image_url, $organization_name)
    {
?>
        <div class="card">
            <a href="index.php"><img src=<?php if ($image_url != null) echo $image_url ?> class="card-img-top" alt="..." id=<?= $org_id ?>></a>
            <span class="organization-title"><?= $organization_name ?></span>
        </div>
<?php
    }
}
