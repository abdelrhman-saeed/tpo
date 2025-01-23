<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Search</title>
    <link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<style>
    /* 
* Design by Robert Mayer:https://goo.gl/CJ7yC8
*
*I intentionally left out the line that was supposed to be below the subheader simply because I don't like how it looks.
*
* Chronicle Display Roman font was substituted for similar fonts from Google Fonts.
*/

    body {
        background-color: #fdf1ec;
        font-family: 'Raleway', sans-serif;
    }

    .wrapper {
        height: 80vh;
        width: 80vw;
        margin: 50px auto;
        border-radius: 7px;
        box-shadow: 0px 14px 32px 0px rgba(0, 0, 0, 0.15);
        display: flex;
        overflow: hidden;
    }

    .product-img {
        flex: 1;
        overflow: hidden;
    }

    .product-img img {
        border-radius: 7px 0 0 7px;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-info {
        flex: 1.5;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 0 7px 7px 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .product-text {
        flex: 1;
    }

    .product-text h1 {
        font-size: 24px;
        color: #474747;
        margin-bottom: 10px;
    }

    .product-text h2 {
        font-size: 16px;
        color: #d2d2d2;
        margin-bottom: 20px;
    }

    .product-text p {
        color: #8d8d8d;
        line-height: 1.7em;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .product-text strong {
        color: #474747;
    }

    .product-price-btn {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-price-btn p {
        font-size: 24px;
        color: #474747;
    }

    .product-price-btn input {
        height: 50px;
        width: 150px;
        border: none;
        border-radius: 25px;
        font-size: 14px;
        text-transform: uppercase;
        color: #ffffff;
        background-color: #9cebd5;
        cursor: pointer;
        outline: none;
    }

    .product-price-btn input:hover {
        background-color: #79b0a1;
    }
</style>

<body>
    <div class="wrapper">
        <div class="product-img">
            <img src="https://i.postimg.cc/W30ZbJym/product-img.png" alt="Product Image">
        </div>
        <?php if (isset($prebook) && !empty($prebook)): ?>
            <div class="product-info">
                <div class="product-text">
                    <h1>Hotel Code: <?php echo $prebook[0]['HotelCode']; ?></h1>
                    <h2>Currency: <?php echo $prebook[0]['Currency']; ?></h2>
                    <p>
                        <strong>Number of rooms:</strong> <?= count($prebook[0]['Rooms'][0]['Name']) ?><br>
                        <?php foreach ($prebook[0]['Rooms'] as $room): ?>
                            <?php foreach ($room['Name'] as $key => $name): ?>
                                <strong>Room Name <?= ($key + 1) ?>:</strong> <?= $name ?><br>
                            <?php endforeach; ?>
                            <strong>Inclusion:</strong> <?php echo $room['Inclusion']; ?><br>
                            <strong>Total Fare:</strong> <?php echo $room['TotalFare']; ?><br>
                            <strong>Total Tax:</strong> <?php echo $room['TotalTax']; ?><br>
                            <strong>Meal Type:</strong> <?php echo $room['MealType']; ?><br>
                            <strong>Amenities:</strong>
                            <?php foreach ($room['Amenities'] as $amen): ?>
                                <span class="badge rounded-pill bg-info text-dark"><?php echo $amen; ?></span>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </p>

                </div>
                <div class="product-price-btn">
                    <p>Total: <?php echo $prebook[0]['Rooms'][0]['TotalFare'] + $prebook[0]['Rooms'][0]['TotalTax']; ?>$</p>

                    <form action="/hotelBook?bookingCode=<?php echo $prebook[0]['Rooms'][0]['BookingCode']; ?>&totalFare=<?php echo $prebook[0]['Rooms'][0]['TotalFare'] + $prebook[0]['Rooms'][0]['TotalTax']; ?>" method="post">
                        <input type="submit" value="Book Now"></input>
                    </form>
                    </form>
                </div>
            </div>
        <?php else: ?>
            <div class="product-info">
                <div class="product-text">
                    <h1>No data found!</h1>
                </div>
            </div>

        <?php endif; ?>
    </div>

</body>

</html>