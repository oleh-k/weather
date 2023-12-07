<?php

namespace App\Services;

use App\Models\ForecastArchive;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\City as CityModel;

class ForecastData
{
    public static function saveForecast($request)
    {

        $validator = Validator::make($request->all(), [
            "name" => "required|alpha",
        ]);

        if ($validator->fails()) {

            $response = [
                "success" => false,
                "message" => $validator->errors(),
            ];
            return $response;
        } else {

            $forecast = WeatherAPI::getCached();

            $city = CityModel::firstOrCreate(['name' => $forecast->city]);

            $forecastArchive = [
                "name" => $request['name'],
                "city_id" => $city->id,
                "user_id" => auth()->user()->id,
            ];

            $message = ForecastArchive::create($forecastArchive);

            $response = [
                "success" => true,
                "message" => $message,
            ];

            return $response;
        }
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
