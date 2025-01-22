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
    <div class="container">
        <h3>Search for a Hotel</h3>
        <form id="hotelSearchForm" action="/TBOHolidays_HotelAPI/HotelSearch" method="post">
            <div>
                <label for="checkIn">Check In</label>
                <input type="date" id="checkIn" name="checkIn" required>
            </div>
            <div>
                <label for="checkOut">Check Out</label>
                <input type="date" id="checkOut" name="checkOut" required>
            </div>
            <div class="rooms_container">
                <label for="rooms_number">Rooms Number</label>
                <input type="number" id="rooms_number" name="rooms_number" value="0" min="0" required>
                <button type="button" id="addRoom">Add Rooms</button>
                <div class="rooms"></div>
            </div>
            <div class="error" id="error_message"></div>
            <input type="submit" value="Submit">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <div class="room">
                            <div>
                                <label for="adults_${i}">Adults</label>
                                <input type="number" id="adults_${i}" name="PaxRooms[${i}]['adults']" value="0" min="0" required>
                            </div>
                            <div>
                                <label for="children_${i}">Children</label>
                                <input type="number" id="children_${i}" name="PaxRooms[${i}]['children']" value="0" min="0" required>
                            </div>
                            <div>
                                <label for="children_ages_${i}">Children Ages</label>
                                <input type="text" id="children_ages_${i}" name="PaxRooms[${i}]['children_ages'][]" placeholder="from" required>
                                <input type="text" id="children_ages_${i}" name="PaxRooms[${i}]['children_ages'][]" placeholder="to" required>
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