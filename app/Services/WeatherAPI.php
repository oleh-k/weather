<?php

namespace App\Services;

class WeatherAPI
{

    public $city;
    public $days;

    public function __construct(string $city, int $days = 3)
    {
        $this->city = $city;
        $this->days = $days;
    }

    public function getWeather()
    {
        $curl = curl_init();

        $url = "https://weatherapi-com.p.rapidapi.com/forecast.json?q=Kyiv&days=3";
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
                "X-RapidAPI-Key: ".$_ENV['WEATHER_API_KEY']
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }
}
