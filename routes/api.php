<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForecastDataController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\WeatherAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/weather', [WeatherAPIController::class, 'getWeather']);
    Route::get('/weather/cache', [WeatherAPIController::class, 'getCached']);

    Route::post('/weather/forecast', [ForecastDataController::class, 'saveForecast']);
    Route::get('/weather/forecast/{id}', [ForecastDataController::class, 'showSavedForecast']);
    Route::get('/weather/forecast', [ForecastDataController::class, 'showSavedForecastList']);

    Route::resource('/city', CityController::class);
});
