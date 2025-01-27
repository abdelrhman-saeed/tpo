<?php require __DIR__ . '/../layout/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <h2 class="text-center mb-4">Login</h2>
            <form action="/login" method="post">
                <div class="form-group mb-3">
                    <label for="email">email</label>
                    <input type="text" class="form-control" id="email" name="email">

                    <?php session_start(); $errors = $_SESSION['registeration_errors'] ?? []; ?>

                    <?php if (isset($errors['email'])): ?>
                        <div class="text-danger"><?php echo $errors['email']; ?></div>
                    <?php endif; ?>

                </div>
                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>

                    <?php if (isset($errors['password'])): ?>
                        <div class="text-danger"><?php echo $errors['password']; ?></div>
                    <?php endif; ?>

                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="text-center mt-3">
                <a href="/register">Signup</a>
            </div>
        </div>
    </div>
</body>
</html>