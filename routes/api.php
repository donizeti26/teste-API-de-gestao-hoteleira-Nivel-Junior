<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::post('/reservations', [ReservationController::class, 'store']);
