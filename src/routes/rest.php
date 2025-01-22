<?php

use AbdelrhmanSaeed\Route\API\Route;
use AbdelrhmanSaeed\Tpo\Controllers\TPOController;


Route::get('TBOHolidays_HotelAPI/HotelSearch', [TPOController::class, 'hotelSearchView']);
Route::post('TBOHolidays_HotelAPI/HotelSearch', [TPOController::class, 'hotelSearch']);


Route::get('TBOHolidays_HotelAPI/AvailableHotelRooms', [TPOController::class, 'availableHotelRoomsView']);
Route::post('TBOHolidays_HotelAPI/AvailableHotelRooms', [TPOController::class, 'availableHotelRooms']);


Route::get('TBOHolidays_HotelAPI/Prebook', [TPOController::class, 'preBookView']);
Route::post('TBOHolidays_HotelAPI/Prebook', [TPOController::class, 'preBook']);
