<?php

namespace Tomconnect\Components;

class NavbarComponent
{
    public static function render()
    {
?>
        <nav class="navbar">
            <div class="logo">
                <h1>TOMCONNECT</h1>
            </div>
            <div class="nav-items">
                <div class="">
                    <a href="">
                        Feed
                    </a>
                </div>
                <div class="nav-items">
                    <a href="">
                        Organizations
                    </a>
                </div>
                <div class="nav-items">
                    <a href="">
                        Events
                    </a>
                </div>
            </div>
        </nav>
<?php
    }
}
