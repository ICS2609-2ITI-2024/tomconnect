<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap and CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="poststyle.css">
    <title>PostComponent</title>
</head>

<body>
    <div class="row row-cols-1 row-cols-md-3 g-2 py-1">
        <div class="col">
            <div class="card cardCustom">
                <div class="d-flex align-items-center">
                    <img src="./imagePost/thomasian.jpg" alt="" class="iconSize me-2">
                    <h6 class="mb-0 nameStyle">Thomasian Gaming Society</h6>
                </div>
                <br>
                <div class="container-fluid mainImageContainer">
                    <img src="./imagePost/ust.jpg" class="card-img-top img-fluid mainImage" alt="...">
                </div>
                <br>
                <h3 class="card-title">Title</h3>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam
                    dignissimos accusantium amet similique velit iste.
                </p>
                <div class="container container-fluid">
                    <div class="tag">
                        <p>University-Wide</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>