<?php

namespace App\Http\Controllers;


class ForecastDataController extends Controller
{
    public function saveForecast()
    {
        return 'saveForecast';
    }

    public function showSavedForecast($id)
    {
        return 'showSavedForecast:'.$id;
    }

    public function showSavedForecastList()
    {
        return 'showSavedForecastList';
    }
}
