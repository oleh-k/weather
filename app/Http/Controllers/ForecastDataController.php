<?php

namespace App\Http\Controllers;
use App\Services\ForecastData;


class ForecastDataController extends Controller
{
    public function saveForecast()
    {
        return ForecastData::saveForecast();
    }

    public function showSavedForecast($id)
    {
        return 'showSavedForecast:'.$id;
    }

    public function showSavedForecastList()
    {
        return ForecastData::showSavedForecastList();
    }
}
