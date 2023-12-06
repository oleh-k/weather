<?php

namespace App\Services;

use App\Models\ForecastArchive;
use Illuminate\Support\Facades\DB;

class ForecastData
{
    public static function saveForecast()
    {

        $forecastArchive = [
            "name" => "name",
            "city_id" => "3",
            "user_id" => auth()->user()->id,
        ];

        return ForecastArchive::create($forecastArchive);
    }
}
