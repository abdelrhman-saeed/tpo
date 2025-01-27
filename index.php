<?php

require 'vendor/autoload.php';


use Dotenv\Dotenv;
use AbdelrhmanSaeed\Route\API\Route;
use Symfony\Component\HttpFoundation\{Request, Response};
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\{EntityManager, ORMSetup};
use AbdelrhmanSaeed\Tpo\Services\Singleton;


// Load environment variables
Dotenv::createImmutable(__DIR__)->load();

// configuring the database connection
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/src/Entities'],
    isDevMode: true,
);

$connection = DriverManager::getConnection([
    'driver'    => $_ENV['DB_DRIVER'],
    'user'      => $_ENV['DB_USER'],
    'password'  => $_ENV['DB_PASSWORD'],
    'dbname'    => $_ENV['DB_NAME'],
], $config);

// obtaining the entity manager
// and storing it in the singleton
Singleton::set(
    EntityManager::class,
    new EntityManager($connection, $config)
);


// Setup routes
Route::setup(
    __DIR__ . '/src/routes',
    Request::createFromGlobals(),
    new Response
);
