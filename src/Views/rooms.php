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
                            <?php if (isset($room['ImageURLs'])): ?>
                                <img src="<?= $room['ImageURLs'][0]; ?>" class="card-img-top" alt="Product 1">
                            <?php else: ?>
                                <img src="https://placehold.co/600x400?text=Hotel Placeholder" alt="Placehold" class="card-img-top">
                            <?php endif; ?>
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