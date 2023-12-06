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

    public static function showSavedForecastList()
    {

        $forecast = DB::table('forecast_archives')
            ->leftJoin('users', 'forecast_archives.user_id', '=', 'users.id')
            ->leftJoin('cities', 'forecast_archives.city_id', '=', 'cities.id')
            ->select('forecast_archives.id', 'forecast_archives.city_id', 'forecast_archives.user_id', 'users.name as user', 'cities.name as city_name')
            ->get();

        return $forecast;
    }
}
