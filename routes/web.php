<?php

use Illuminate\Support\Facades\Route;



Route::get('/register', function () {
    return view('register');
});

Route::get('/{any}', function () {
    return view('welcome');
});
