<?php

namespace App\Services;


use App\Models\User as userModel;
use Illuminate\Support\Facades\Validator;

class User
{
    public static function register($request): array
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc|unique:users',
            'password' => 'required|confirmed|min:6|max:64',
        ]);

        if ($validator->fails()) {
            $response = [
                "success" => false,
                "message" => $validator->errors()
            ];
            return $response;
        } else {

            $userModel = userModel::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password'])
            ]);

            $token = $userModel->createToken($request['password'] . 'myapp_weather')->plainTextToken;

            if ($userModel) {

                $response = [
                    "success" => true,
                    "token" => $token,
                    "message" => $userModel
                ];
                return $response;
            } else {
                $response = [
                    "success" => false,
                    "message" => $userModel
                ];
                return $response;
            }
        }
    }
}
