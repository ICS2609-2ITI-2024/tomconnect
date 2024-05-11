<?php

namespace Tomconnect\Components;

class Footer {

    public static function render()
    {
        ?>
<footer>
        <div class="container-fluid text-center">
           <p>© Copyright <?= date("Y") ?>. University of Santo Tomas. All Rights Reserved. </p>
        </div>
    </footer>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
<?php
    }
}