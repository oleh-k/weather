<?php

namespace App\Services;

use App\Models\City as CityModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class City
{

    public static function index()
    {
        return CityModel::all();
    }

    public static function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha',
        ]);

        if ($validator->fails()) {
            $response = [
                "success" => false,
                "message" => $validator->errors()
            ];
            return $response;
        } else {
            $response = [
                "success" => true,
                "message" => CityModel::create($request->all())
            ];
            return $response;
        }
    }

    public static function destroy(int $id)
    {
        $city = CityModel::find($id);

        if (!$city) {
            $response = [
                "success" => false,
                "message" => "City not found",
            ];
            return $response;
        }

        $city->delete();

        $response = [
            "success" => true,
            "message" => "City deleted successfully",
        ];
        return $response;
    }
}
