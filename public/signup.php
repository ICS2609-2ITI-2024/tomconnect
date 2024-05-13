<?php

declare(strict_types=1);

require_once (dirname(__DIR__)) . "\\vendor\\autoload.php";

use Tomconnect\Components\Header;
use Tomconnect\Components\Footer;

Header::render('Tomconnect Sign Up');

Footer::render();
