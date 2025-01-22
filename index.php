<?php

require 'vendor/autoload.php';


use AbdelrhmanSaeed\Route\API\Route;
use Symfony\Component\HttpFoundation\{Request, Response};


Route::setup(
    __DIR__ . '/src/routes',
    Request::createFromGlobals(),
    new Response
);
