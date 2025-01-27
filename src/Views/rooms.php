<!DOCTYPE html>
<html lang="en">

<head>
    <?php require 'layout/header.php'; ?>
    <title>Hotel Search</title>
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
    <?php require 'layout/nav.php'; ?>
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
                                <img src="https://placehold.co/600x400?text=Room Placeholder" alt="Placehold" class="card-img-top">
                            <?php endif; ?>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                    <p class="card-text mb-0">Number of rooms: <?= count($room['Name']) ?></p>
                                    <form action="Prebook" method="post">
                                        <input type="hidden" name="BookingCode" value="<?= $room['BookingCode'] ?>">
                                        <input type="submit" class="btn btn-primary" value="BOOK"></input>
                                    </form>
                                </div>
                                <?php foreach ($room['Name'] as $key => $name): ?>
                                    <h5 class="card-title">
                                        <span class="d-block">Room Name <?= ($key + 1) ?>: <?= $name ?></span>
                                    </h5>
                                <?php endforeach; ?>
                                <p class="card-text">Inclusion: <?= $room['Inclusion'] ?></p>
                                <p class="card-text">Total Fare: <?= $room['TotalFare'] ?></p>
                                <p class="card-text">Total Tax: <?= $room['TotalTax'] ?></p>
                                <?php if (!empty($room['RoomPromotion'])): ?>
                                    <div class="card-text">
                                        <span>Room Promotion:</span>
                                        <ul>
                                            <?php foreach ($room['RoomPromotion'] as $key => $promotion): ?>
                                                <li>Room <?= ($key + 1) ?>: <?= $promotion ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
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



<?php require 'js.php'; ?>
</body>

</html>