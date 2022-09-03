<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/login', function () {
    return view('auth');
});
Route::get('auth/register', function () {
    return view('auth');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});
