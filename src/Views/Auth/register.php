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
            <h2 class="text-center mb-4">Register</h2>
            <form action="/register" method="post">
                <div class="form-group mb-3">
                    <label for="name">name</label>
                    <input type="name" class="form-control" id="name" name="name" required>

                    <?php session_start(); $errors = $_SESSION['registeration_errors'] ?? []; ?>

                    <?php if (isset($errors['name'])): ?>
                        <div class="text-danger"><?php echo $errors['name']; ?></div>
                    <?php endif; ?>

                </div>
                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>

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
                <div class="form-group mb-3">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="form-group mb-3">
                    <label for="phone">phone</label>
                    <input type="phone" class="form-control" id="phone" name="phone" required>

                    <?php if (isset($errors['phone'])): ?>
                        <div class="text-danger"><?php echo $errors['phone']; ?></div>
                    <?php endif; ?>

                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <div class="text-center mt-3">
                <a href="/login">Already have an account? Login</a>
            </div>
        </div>
    </div>
</body>
</html>