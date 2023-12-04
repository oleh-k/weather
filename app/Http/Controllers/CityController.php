<?php

namespace App\Http\Controllers;

use App\Services\City;
use Illuminate\Http\Request;


class CityController extends Controller
{

    public function index()
    {
        return City::index();
    }

    public function store(Request $request)
    {
        return City::store($request);
    }


    public function destroy(int $id)
    {
        return City::destroy($id);
    }
}
