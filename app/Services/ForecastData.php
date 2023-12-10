<?php

namespace App\Services;

use App\Models\ForecastArchive;
use Illuminate\Support\Facades\Validator;
use App\Models\City as CityModel;
use App\Models\ForecastData as ModelsForecastData;
use App\Models\User as userModel;

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

            foreach ($forecast->forecast as $v) {
                self::saveDataForEachDay($v, $message->id);
            }

            $response = [
                "success" => true,
                "message" => $message,
            ];

            return $response;
        }
    }

    public static function saveDataForEachDay($day, $id)
    {
        
        return ModelsForecastData::create([
            "user_id"=> auth()->user()->id,
            "forecast_archive_id"=> $id,
            "date"=> $day->date,
            "maxtemp"=> $day->maxtemp,
            "mintemp"=> $day->mintemp,
            "avgtemp"=> $day->avgtemp,
            "daily_chance_of_rain"=> $day->daily_chance_of_rain,
            "daily_chance_of_snow"=> $day->daily_chance_of_snow,
        ]);
        
    }

    public static function showSavedForecastList()
    {

        $user = userModel::with('forecastArchives.city', 'forecastArchives.forecastData')->find(auth()->user()->id);

        if (!$user) {
            $response = [
                "success" => false,
                "message" => "User not found",
            ];
            return $response;
        }


        return $response;
    }
}
