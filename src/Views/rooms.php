<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            /* max-width: 600px; */
            margin: 0 auto;
        }

        .rooms_container {
            border: 2px solid black;
            padding: 2em;
            width: 100%;
            margin-bottom: 2em;
            box-sizing: border-box;
        }

        .room {
            border: 1px solid black;
            padding: 1em;
            margin-top: 1em;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-bottom: 0.5em;
        }

        input[type="number"],
        input[type="date"],
        input[type="text"] {
            width: 100%;
            padding: 0.5em;
            margin-bottom: 1em;
            box-sizing: border-box;
        }

        button {
            padding: 0.5em 1em;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        input[type="submit"] {
            padding: 0.5em 1em;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .error {
            color: red;
            margin-bottom: 1em;
        }
    </style>
</head>

<body>

    <?php if (isset($availableRooms) && !empty($availableRooms)): ?>
        <div class="container py-5">
            <h1 class="text-center mb-5">Available Rooms</h1>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($availableRooms as $room): ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?= $room['ImageURLs'][0] ?>" class="card-img-top" alt="Product 1">
                            <!-- <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">

                                    <?php foreach ($room['ImageURLs'] as $image): ?>
                                        <div class="carousel-item active">
                                            <img src="<?= $image ?>" class="d-block w-100" alt="...">
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div> -->
                            <div class="card-body">
                                <p class="card-text">number of rooms: <?= count($room['Name']) ?></p>
                                <h5 class="card-title"><?php
                                                        foreach ($room['Name'] as $key => $name) {
                                                            echo 'Room Name ' . ($key + 1) . ': ';
                                                            echo $name . "<br>";
                                                        }
                                                        ?></h5>
                                <p class="card-text">Inclusion: <?= $room['Inclusion'] ?></p>
                                <p class="card-text">Total Fare: <?= $room['TotalFare'] ?></p>
                                <p class="card-text">TotalTax: <?= $room['TotalTax'] ?></p>
                                <?php if (! empty($room['RoomPromotion'])): ?>
                                    <p class="card-text">
                                        <span>Room Promotion:</span>
                                    <ul>
                                        <?php
                                        foreach ($room['RoomPromotion'] as $key => $promotion) {
                                            echo '<li>';
                                            echo 'Room ' . ($key + 1) . ': ';
                                            echo $promotion . "<br>";
                                            echo '</li>';
                                        }
                                        ?>

                                    </ul>
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($room['Supplements'])): ?>
                                    <p class="card-text">
                                        <span>Supplements:</span>
                                        <?php foreach ($room['Supplements'] as $supplement): ?>
                                            <?php foreach ($supplement as $supplementDetail): ?>
                                                <br>Index: <?= $supplementDetail['Index'] ?>
                                                <br>Type: <?= $supplementDetail['Type'] ?>
                                                <br>Description: <?= $supplementDetail['Description'] ?>
                                                <br>Price: <?= $supplementDetail['Price'] ?>
                                                <br>Currency: <?= $supplementDetail['Currency'] ?>
                                                <br>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </p>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else: ?>
        <p>No avialable Room for now!</p>
    <?php endif; ?>

</body>

</html>