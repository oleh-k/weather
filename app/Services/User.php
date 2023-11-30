<?php

namespace App\Services;


use App\Models\User as userModel;
use Illuminate\Support\Facades\Hash;
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

    public static function login($request): array
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email:rfc',
            'password' => 'required|min:6|max:64',
        ]);

        if ($validator->fails()) {
            $response = [
                "success" => false,
                "message" => $validator->errors()
            ];
            return $response;
        } else {

            $userModel = userModel::where('email', $request['email'])->first();

            if (!$userModel || !Hash::check($request['password'], $userModel->password)) {

                $response = [
                    "success" => false,
                    "message" => "bad creds"
                ];
                return $response;;
            }

            $token = $userModel->createToken($request['password'] . 'myapp_bard')->plainTextToken;

            if ($token) {

                $response = [
                    "success" => true,
                    "token" => $token,
                    "message" => $userModel
                ];
                return $response;
            } else {

                $response = [
                    "success" => false,
                    "message" => "bad creds"
                ];
                return $response;
            }
        }
    }


    public static function logout(): array
    {
        auth('sanctum')->user()->tokens()->delete();
        return ['success' => true];
    }
}
