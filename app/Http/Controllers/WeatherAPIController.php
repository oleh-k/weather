<?php

namespace App\Http\Controllers;

use App\Services\WeatherAPI;
use Illuminate\Http\Request;

class WeatherAPIController extends Controller
{
    public function getWeather(Request $request)
    {

        $weather = new WeatherAPI($request->all());
        $response = $weather->getWeather();

        if ($response["success"] === true) {
            return $response;
        } else {
            return response($request, 400);
        }
    }

    public function setCache(Request $request)
    {
        return WeatherAPI::setCache($request->all());
    }

    public function getCached()
    {
        return WeatherAPI::getCached();
    }
}
