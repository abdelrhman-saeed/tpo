<?php

declare(strict_types=1);

namespace AbdelrhmanSaeed\Tpo\Controllers;

use AbdelrhmanSaeed\Tpo\Services\Singleton;
use Doctrine\ORM\EntityManager;

class AuthController
{
    private $error = '';

    public function login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];


        if (empty(trim($email)) || empty(trim($password))) {
            $this->error = 'Please enter your email and password';
            return;
        }

        $sql = "SELECT * FROM users WHERE email = ?";

        if ($stmt = $mysqli->prepare($sql)) {
            $stmt->bind_param("s", $param_email);

            $param_email = $email;

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username, $hashed_password);

                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            // // session_start();
                            // $_SESSION['loggedin'] = true;
                            // $_SESSION['id'] = $id;
                            // $_SESSION['email'] = $email;
                            // // header("location: welcome.php");



                        } else {
                            $this->error = 'Invalid email or password';
                        }
                    }
                } else {
                    $this->error = 'Invalid email or password';
                }
            } else {
                $this->error = "Oops! Something went wrong. Please try again later.";
            }

            $stmt->close();
        }

        $mysqli->close();
    }
}
