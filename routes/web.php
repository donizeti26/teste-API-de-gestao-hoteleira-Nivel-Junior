<?php

use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/import-hotels', [ImportController::class, 'importHotels']);

Route::get('/import-rooms', [ImportController::class, 'importRooms']);

Route::get('/import-rates', [ImportController::class, 'importRates']);

Route::get('/import-reservations', [ImportController::class, 'importReservations']);


Route::get('/test-reservation', [ReservationController::class, 'store']);
