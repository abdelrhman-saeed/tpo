<?php

use AbdelrhmanSaeed\Route\API\Route;
use AbdelrhmanSaeed\Tpo\Controllers\AuthController;
use AbdelrhmanSaeed\Tpo\Controllers\TPOController;


Route::get('TBOHolidays_HotelAPI/HotelSearch', [TPOController::class, 'hotelSearchView']);
Route::post('TBOHolidays_HotelAPI/HotelSearch', [TPOController::class, 'hotelSearch']);


Route::get('TBOHolidays_HotelAPI/AvailableHotelRooms', [TPOController::class, 'availableHotelRoomsView']);
Route::post('TBOHolidays_HotelAPI/AvailableHotelRooms', [TPOController::class, 'availableHotelRooms']);


Route::get('TBOHolidays_HotelAPI/Prebook', [TPOController::class, 'preBookView']);
Route::post('TBOHolidays_HotelAPI/Prebook', [TPOController::class, 'preBook']);

Route::get('hotelBook', [TPOController::class, 'hotelBookView']);
Route::post('hotelBook', [TPOController::class, 'hotelBook']);

Route::get('confirmBookingList', [TPOController::class, 'confirmBookingView']);
Route::post('cancelConfirm', [TPOController::class, 'cancelConfirm']);

// authentication routes
Route::get('register', [AuthController::class, 'registerView']);
Route::post('register', [AuthController::class, 'register']);