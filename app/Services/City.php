<?php

namespace App\Services;

use App\Models\City as CityModel;

class City
{

    public static function index()
    {
        return CityModel::all();
    }

}
