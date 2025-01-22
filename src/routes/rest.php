<?php

use AbdelrhmanSaeed\Route\API\Route;
use AbdelrhmanSaeed\Tpo\Controllers\TPOController;


Route::get('TBOHolidays_HotelAPI/HotelSearch', [TPOController::class, 'hotelSearch']);
