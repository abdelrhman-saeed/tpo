<!DOCTYPE html>
<html lang="en">

    <header>
        <?php require 'header.php'; ?>
        <Title>Hotel Book</Title>
    </header>

    <body>
        <div class="container mt-5">
            <h2 class="mb-4">Add Customer Data for Each Room</h2>
            
            <?php $action = "/hotelBook/$BookingCode/$TotalFare"; ?>
            <form action="<?php echo $action; ?>" method="post" id="customerForm">

                <div id="roomData">
                    <div class="room-section mb-4">
                        <h4>Room 1</h4>
                        <div id="customerData1">
                            <div class="form-row mb-4">
                                <div class="form-group col-md-2">
                                    <label for="Title">Title</label>
                                    <select class="form-control" id="Title" name="CustomerDetails[1][CustomerNames][0][Title]" required>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Ms">Ms</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="FirstName">First Name</label>
                                    <input type="text" class="form-control" id="FirstName" name="CustomerDetails[1][CustomerNames][0][FirstName]" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="LastName">Last Name</label>
                                    <input type="text" class="form-control" id="LastName" name="CustomerDetails[1][CustomerNames][0][LastName]" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="type">Type</label>
                                    <select class="form-control" id="type" name="CustomerDetails[1][CustomerNames][0][Type]" required>
                                        <option value="adult">Adult</option>
                                        <option value="child">Child</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary addCustomer" data-room="1">Add Another Customer</button>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" id="addRoom">Add Another Room</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <?php require 'js.php'; ?>
        <script>
            $(document).ready(function() {
                var roomCount = 1;

                $("#addRoom").click(function() {
                    roomCount++;
                    var newRoom = `
                        <div class="room-section mb-4">
                            <h4>Room ` + roomCount + `</h4>
                            <div id="customerData` + roomCount + `">
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-2">
                                        <label for="Title">Title</label>
                                        <select class="form-control" id="Title" name="CustomerDetails[` + roomCount + `][CustomerNames][0][Title]" required>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Miss">Miss</option>
                                            <option value="Ms">Ms</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="FirstName">First Name</label>
                                        <input type="text" class="form-control" id="FirstName" name="CustomerDetails[` + roomCount + `][CustomerNames][0][FirstName]" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="LastName">Last Name</label>
                                        <input type="text" class="form-control" id="LastName" name="CustomerDetails[` + roomCount + `][CustomerNames][0][LastName]" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="type">Type</label>
                                        <select class="form-control" id="type" name="CustomerDetails[` + roomCount + `][CustomerNames][0][Type]" required>
                                            <option value="adult">Adult</option>
                                            <option value="child">Child</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary addCustomer" data-room="` + roomCount + `">Add Another Customer</button>
                        </div>`;
                    $("#roomData").append(newRoom);
                });

                $(document).on("click", ".addCustomer", function() {
                    var roomNumber = $(this).data("room");
                    var customerCount = $("#customerData" + roomNumber + " .form-row").length;
                    var newCustomer = `
                        <div class="form-row mb-4">
                            <div class="form-group col-md-2">
                                <label for="Title">Title</label>
                                <select class="form-control" id="Title" name="CustomerDetails[` + roomNumber + `][CustomerNames][` + customerCount + `][Title]" required>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Ms">Ms</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="FirstName">First Name</label>
                                <input type="text" class="form-control" id="FirstName" name="CustomerDetails[` + roomNumber + `][CustomerNames][` + customerCount + `][FirstName]" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="LastName">Last Name</label>
                                <input type="text" class="form-control" id="LastName" name="CustomerDetails[` + roomNumber + `][CustomerNames][` + customerCount + `][LastName]" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="type">Type</label>
                                <select class="form-control" id="type" name="CustomerDetails[` + roomNumber + `][CustomerNames][` + customerCount + `][type]" required>
                                    <option value="adult">Adult</option>
                                    <option value="child">Child</option>
                                </select>
                            </div>
                        </div>`;
                    $("#customerData" + roomNumber).append(newCustomer);
                });
            });
        </script>
    </body>

</html>