<!DOCTYPE html>
<html lang="en">

<header>
    <?php require 'layout/header.php'; ?>
    <Title>Hotel Book</Title>
</header>

<body>
    <?php require 'layout/nav.php'; ?>
    <div class="container mt-5">

        <h2 class="mb-4">Add Customer Data for Each Room</h2>

        <form action="/hotelBook" method="post" id="customerForm">

            <input type="hidden" value="<?= $bookingCode ?>" name="bookingCode">
            <input type="hidden" value="<?= $totalFare ?>" name="totalFare">

            <div id="roomData">

                <?php session_start(); ?>

                <?php foreach ($_SESSION['PaxRooms'] as $i => $room): ?>
                    <div class="room-section mb-4">
                        <h4>Room <?= $i + 1 ?></h4>
                        <div id="customerData1 mb-3">
                            <h5> Add Adults Info </h5>
                            <?php for ($j = 0; $j < $room['Adults']; $j++): ?>

                                <input type="hidden" name="CustomerDetails[<?= $i ?>][CustomerNames][<?= $j ?>][Type]" value="Adult">
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-2">
                                        <label for="Title">Title</label>
                                        <select class="form-control" id="Title" name="CustomerDetails[<?= $i ?>][CustomerNames][<?= $j ?>][Title]" required>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Miss">Miss</option>
                                            <option value="Ms">Ms</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="FirstName">First Name</label>
                                        <input type="text" class="form-control" id="FirstName" name="CustomerDetails[<?= $i ?>][CustomerNames][<?= $j ?>][FirstName]" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="LastName">Last Name</label>
                                        <input type="text" class="form-control" id="LastName" name="CustomerDetails[<?= $i ?>][CustomerNames][<?= $j ?>][LastName]" required>
                                    </div>
                                </div>
                            <?php endfor; ?>

                            <?php if ($room['Children'] > 0): ?>
                                <h5> Add Children Info </h5>
                                <?php for ($j = $room['Adults']; $j < $room['Adults'] + $room['Children']; $j++): ?>

                                    <input type="hidden" name="CustomerDetails[<?= $i ?>][CustomerNames][<?= $j ?>][Type]" value="Child">
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-2">
                                            <label for="Title">Title</label>
                                            <select class="form-control" id="Title" name="CustomerDetails[<?= $i ?>][CustomerNames][<?= $j ?>][Title]" required>
                                                <option value="Mr">Mr</option>
                                                <option value="Mrs">Mrs</option>
                                                <option value="Miss">Miss</option>
                                                <option value="Ms">Ms</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="FirstName">First Name</label>
                                            <input type="text" class="form-control" id="FirstName" name="CustomerDetails[<?= $i ?>][CustomerNames][<?= $j ?>][FirstName]" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="LastName">Last Name</label>
                                            <input type="text" class="form-control" id="LastName" name="CustomerDetails[<?= $i ?>][CustomerNames][<?= $j ?>][LastName]" required>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <?php require 'js.php'; ?>

</body>

</html>