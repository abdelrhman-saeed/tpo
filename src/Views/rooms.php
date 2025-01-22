<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Search</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
            <h1 class="text-center mb-5">Avialable Rooms</h1>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($availableRooms as $room): ?>
                    <div class="col">
                        <div class="card h-100">
                            <div id="carouselExampleControls<?= $room['BookingCode'] ?>" class="carousel slide" data-ride="carousel">
                                <!-- <div class="carousel-inner">
                            <?php foreach ($room['ImageURLs'] as $img): ?>
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="<?= $img ?>" alt="First slide">
                                </div>
                            <?php endforeach; ?>
                        </div> -->
                                <a class="carousel-control-prev" href="#carouselExampleControls<?= $room['BookingCode'] ?>" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls<?= $room['BookingCode'] ?>" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $room['Name'][0] ?></h5>
                                <p class="card-text"><?= $room['Inclusion'] ?></p>
                                <p class="card-text">Total Fare: <?= $room['TotalFare'] ?></p>
                                <form action="" method="post">
                                    <input type="submit" class="btn btn-primary" value="Book Now"></input>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No avialable Room for now!</p>
        <?php endif; ?>


        <?php if (isset($availableRooms) && !empty($availableRooms)): ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card product-card">
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title product-title">Product Name</h5>
                                <p class="card-text">A brief description of the product goes here. It should be concise yet
                                    informative.</p>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="product-price">$99.99</span>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span class="ms-1 text-muted">(4.5)</span>
                                    </div>
                                </div>
                                <button class="btn btn-primary w-100">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <?php else: ?>
            <p>No avialable Room for now!</p>
        <?php endif; ?>

</body>

</html>