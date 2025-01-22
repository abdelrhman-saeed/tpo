<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Search</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>


<body>
    <div class="container mt-5">
        <form action="/TBOHolidays_HotelAPI/HotelSearch" method="post" class="mb-3">
            <div class="form-group">
                <label for="checkIn">Check-In Date</label>
                <input type="date" class="form-control" id="checkIn" name="CheckIn" required>
            </div>
            <div class="form-group">
                <label for="checkOut">Check-Out Date</label>
                <input type="date" class="form-control" id="checkOut" name="CheckOut" required>
            </div>
            <div class="form-group">
                <label for="rooms_number">Number of Rooms</label>
                <input type="number" class="form-control" id="rooms_number" name="rooms_number" min="1" required>
            </div>
            <button id="addRoom" type="button" class="btn btn-primary">Add Room</button>
            <div class="rooms mt-3"></div>
            <div class="error text-danger mb-3" id="error_message"></div>
            <input type="submit" class="btn btn-success" value="Submit">
        </form>
        <div id="hotelCardsContainer" class="row">

            <?php if (isset($hotels)): ?>
                <?php foreach ($hotels as $hotel): ?>
                    <form action="/TBOHolidays_HotelAPI/AvailableHotelRooms" method="post" class="col-md-6 mb-3">
                        <input type="hidden" name="hotelId" value="<?php echo $hotel['HotelBookingCode']; ?>">
                        <button type="submit" class="btn btn-primary mb-2">View Rooms</button>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $hotel['HotelInfo']['HotelName']; ?></h5>
                                <img src="<?php echo $hotel['HotelInfo']['HotelPicture']; ?>" class="img-fluid hotel-image" alt="Responsive image">
                                <p class="card-text"><?php echo $hotel['HotelInfo']['HotelDescription']; ?></p>
                                <p class="card-text">Latitude: <?php echo $hotel['HotelInfo']['Latitude']; ?></p>
                                <p class="card-text">Longitude: <?php echo $hotel['HotelInfo']['Longitude']; ?></p>
                                <p class="card-text">Rating: <?php echo $hotel['HotelInfo']['Rating']; ?></p>
                                <p class="card-text">Trip Advisor Rating: <?php echo $hotel['HotelInfo']['TripAdvisorRating']; ?></p>
                                <p class="card-text">Total Price: <?php echo $hotel['MinHotelPrice']['TotalPrice']; ?></p>
                                <p class="card-text">Currency: <?php echo $hotel['MinHotelPrice']['Currency']; ?></p>
                                <p class="card-text">Original price: <?php echo $hotel['MinHotelPrice']['OriginalPrice']; ?></p>
                            </div>
                        </div>
                    </form>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#addRoom").click(function() {
                let roomsNumber = Number($("#rooms_number").val());
                let rooms = $(".rooms");
                let errorMessage = $("#error_message");

                if (roomsNumber <= 0) {
                    errorMessage.text("Please enter a valid number of rooms.");
                    return;
                }

                rooms.empty();
                errorMessage.text("");

                for (let i = 0; i < roomsNumber; i++) {
                    rooms.append(`
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="adults_${i}">Adults</label>
                                    <input type="number" class="form-control" id="adults_${i}" name="PaxRooms[${i}][Adults]" value="0" min="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="children_${i}">Children</label>
                                    <input type="number" class="form-control" id="children_${i}" name="PaxRooms[${i}][Children]" value="0" min="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="children_ages_${i}">Children Ages</label>
                                    <input type="text" class="form-control" id="children_ages_${i}" name="PaxRooms[${i}][ChildrenAges]" required>
                                </div>
                            </div>
                        </div>
                    `);
                }
            });

            $("#hotelSearchForm").submit(function(event) {
                let isValid = true;
                let errorMessage = $("#error_message");
                errorMessage.text("");

                let checkInDate = new Date($("#checkIn").val());
                let checkOutDate = new Date($("#checkOut").val());

                if (checkOutDate <= checkInDate) {
                    isValid = false;
                    errorMessage.text("Check-out date must be greater than check-in date.");
                }

                let roomsNumber = Number($("#rooms_number").val());
                if (roomsNumber <= 0) {
                    isValid = false;
                    errorMessage.text("Please enter a valid number of rooms.");
                }

                $(".room").each(function() {
                    let adults = $(this).find("input[name*='adults']").val();
                    let children = $(this).find("input[name*='children']").val();
                    let childrenAges = $(this).find("input[name*='children_ages']").val();

                    if (adults < 0 || children < 0) {
                        isValid = false;
                        errorMessage.text("Please enter valid numbers for adults and children.");
                        return false;
                    }
                });

                if (!isValid) {
                    event.preventDefault();
                }
            });
        });
    </script>


</body>


</html>