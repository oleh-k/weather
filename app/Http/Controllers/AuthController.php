<?php

namespace App\Http\Controllers;

use App\Services\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        return User::register($request);
    }
}
