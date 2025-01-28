<?php

use AbdelrhmanSaeed\Route\API\Route;
use AbdelrhmanSaeed\Tpo\Controllers\AuthController;


Route::setController(AuthController::class)
        ->group(function (): void
            {
                Route::get('register', 'registerView');
                Route::get('login', 'loginView');

                Route::post('register', 'register');
                Route::post('login', 'login');
            });

