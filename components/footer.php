<?php

namespace Tomconnect\Components;

class Footer {

    public static function render()
    {
        ?>
    <footer>
        <p>© Copyright <?= date("Y") ?>. University of Santo Tomas. All Rights Reserved. </p>
    </footer>
    </body>
    <script src="./js/script.js"></script>
</html>
<?php
    }
}