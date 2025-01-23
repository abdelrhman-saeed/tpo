<!DOCTYPE html>
<html lang="en">

<header>
    <?php require 'header.php'; ?>
    <Title>Hotel Book</Title>
</header>

<body>
    <?php require 'nav.php'; ?>
    <div class="container">
        <h2 class="text-center font-weight-bold">Confirmation Numbers</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
            <?php foreach ($conNums as $conNum) : ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($conNum["ClientReferenceId"]); ?></h5>
                            <p class="card-text">Confirmation Number: <?php echo htmlspecialchars($conNum["ConfirmationNumber"]); ?></p>
                            <form action="/cancelConfirm" method="post">
                                <input type="hidden" name="confirmNum" value="<?php echo htmlspecialchars($conNum["ConfirmationNumber"]); ?>">
                                <button type="submit" class="btn btn-danger float-right">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>


<?php require 'js.php'; ?>
</body>

</html>