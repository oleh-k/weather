<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WeatherAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/weather', [WeatherAPIController::class, 'getWeather']);
});
Route::post('/weather/cache', [WeatherAPIController::class, 'setCache']);

