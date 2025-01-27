<?php

require 'vendor/autoload.php';


use Dotenv\Dotenv;
use AbdelrhmanSaeed\Route\API\Route;
use Symfony\Component\HttpFoundation\{Request, Response};


// Load environment variables
Dotenv::createImmutable(__DIR__)->load();

// Load database connection
require __DIR__ . '/src/Database/bootstrap.php';

// Setup routes
Route::setup(
    __DIR__ . '/src/routes',
    Request::createFromGlobals(), new Response
);
