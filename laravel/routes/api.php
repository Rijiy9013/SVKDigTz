<?php

use App\Http\Controllers\ShowController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/shows', [ShowController::class, 'index']);
Route::get('/shows/{id}/events', [ShowController::class, 'showEvents']);
Route::get('/events/{id}/seats', [ShowController::class, 'eventSeats']);
Route::post('/events/{id}/book', [ShowController::class, 'bookSeats']);
