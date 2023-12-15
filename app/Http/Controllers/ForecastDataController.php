<?php

namespace App\Http\Controllers;
use App\Services\ForecastData;
use Illuminate\Http\Request;

class ForecastDataController extends Controller
{
    public function saveForecast(Request $request)
    {
        return ForecastData::saveForecast($request);
    }

    public function showSavedForecast($id)
    {
        return ForecastData::showSavedForecast($id);
    }

    public function showSavedForecastList()
    {
        return ForecastData::showSavedForecastList();
    }
}
