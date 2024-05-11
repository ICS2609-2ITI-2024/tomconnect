<?php

declare(strict_types=1);


require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Components\OrganizationCard;
use Tomconnect\Models\OrganizationModel;
use Tomconnect\Components\Footer;
use Tomconnect\Components\Header;
use Tomconnect\Components\NavbarComponent;


Header::render('tomconnect');
NavbarComponent::render();
Footer::render();
?>