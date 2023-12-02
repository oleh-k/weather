<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class WeatherAPI
{

    public $city;
    public $days;

    public function __construct(array $request)
    {
        $this->city = isset($request["city"]) ? $request["city"] : 'Kyiv';
        $this->days = isset($request["days"]) ? $request["days"] : '3';
    }

    public function getWeather()
    {
        $curl = curl_init();

        $url = "https://weatherapi-com.p.rapidapi.com/forecast.json?q=$this->city&days=$this->days";
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: weatherapi-com.p.rapidapi.com",
                "X-RapidAPI-Key: " . $_ENV['WEATHER_API_KEY']
            ],
        ]);

        $res = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            $response = [
                "success" => false,
                "message" => $err,
            ];
        } else {
            $response = [
                "success" => true,
                "message" => json_decode($res),
            ];
            $this->setCache($response);
        }

        return $response;
    }

    public static function setCache(array $data)
    {
        $user = Auth::user();
        Redis::set("forecast:$user->id", json_encode($data));
        return ["success" => true];
    }


    public static function getCached()
    {
        $user = Auth::user();
        return json_decode(Redis::get("forecast:$user->id"));
    }

        return json_decode(Redis::get('test'));
    }
}
