<?php

namespace AbdelrhmanSaeed\Tpo\Controllers;

use AbdelrhmanSaeed\Tpo\Services\Singleton;
use Doctrine\ORM\EntityManager;


class AuthController
{
    public function registerView()
    {
        require __DIR__ . '/../Views/Auth/register.php';
    }
}