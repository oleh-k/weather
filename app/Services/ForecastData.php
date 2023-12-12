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
            "user_id" => auth()->user()->id,
            "forecast_archive_id" => $id,
            "date" => $day->date,
            "maxtemp" => $day->maxtemp,
            "mintemp" => $day->mintemp,
            "avgtemp" => $day->avgtemp,
            "daily_chance_of_rain" => $day->daily_chance_of_rain,
            "daily_chance_of_snow" => $day->daily_chance_of_snow,
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

        $message = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'city' => $user->forecastArchives[0]->city->name,
            'forecast_archives' => $user->forecastArchives->map(function ($archive) {
                return [
                    'id' => $archive->id,
                    'name' => $archive->name,
                    'forecast_data' => $archive->forecastData->map(function ($data) {
                        return [
                            'id' => $data->id,
                            'date' => $data->date,
                            'maxtemp' => $data->maxtemp,
                            'mintemp' => $data->mintemp,
                            'avgtemp' => $data->avgtemp,
                            'daily_chance_of_rain' => $data->daily_chance_of_rain,
                            'daily_chance_of_snow' => $data->daily_chance_of_snow,
                        ];
                    }),
                ];
            }),
        ];

        $response = [
            "success" => true,
            "message" => $message,
        ];

        return $response;
    }

    public static function showSavedForecast($id)
    {
        return 'showSavedForecast:'.$id;
    }
}
