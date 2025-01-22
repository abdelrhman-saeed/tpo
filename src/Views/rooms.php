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
                <?php foreach ($availableRooms as $key => $room): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <?php if (isset($room['ImageURLs'])): ?>
                                <div id="carouselExampleControls<?= $key ?>" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <?php foreach ($room['ImageURLs'] as $imageKey => $image): ?>
                                            <div class="carousel-item <?= $imageKey === 0 ? 'active' : ''; ?>">
                                                <img src="<?= $image; ?>" class="d-block w-100" height="250px" alt="...">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls<?= $key ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls<?= $key ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            <?php else: ?>
                                <img src="https://placehold.co/600x400?text=Hotel Placeholder" alt="Placehold" class="card-img-top">
                            <?php endif; ?>
                            <div class="card-body">
                                <p class="card-text">Number of rooms: <?= count($room['Name']) ?></p>
                                <?php foreach ($room['Name'] as $key => $name): ?>
                                    <h5 class="card-title">
                                        <span class="d-block">Room Name <?= ($key + 1) ?>: <?= $name ?></span>
                                    </h5>
                                <?php endforeach; ?>
                                <p class="card-text">Inclusion: <?= $room['Inclusion'] ?></p>
                                <p class="card-text">Total Fare: <?= $room['TotalFare'] ?></p>
                                <p class="card-text">Total Tax: <?= $room['TotalTax'] ?></p>
                                <?php if (!empty($room['RoomPromotion'])): ?>
                                    <p class="card-text">
                                        <span>Room Promotion:</span>
                                    <ul>
                                        <?php foreach ($room['RoomPromotion'] as $key => $promotion): ?>
                                            <li>Room <?= ($key + 1) ?>: <?= $promotion ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    </p>
                                <?php endif; ?>
                                <?php if (!empty($room['Supplements'])): ?>
                                    <p class="card-text">
                                        <span>Supplements:</span>
                                        <?php foreach ($room['Supplements'] as $supplement): ?>
                                            <?php foreach ($supplement as $supplementDetail): ?>
                                                <br>Room: <?= $supplementDetail['Index'] ?>
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
        <p>No available rooms for now!</p>
    <?php endif; ?>
</body>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>