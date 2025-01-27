<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\{EntityManager, ORMSetup};
use AbdelrhmanSaeed\Tpo\Services\Singleton;


$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/Entities'],
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