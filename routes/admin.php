<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('backend.auth.login');
});

Route::get('/forget', function () {
    return view('backend.auth.forget');
});

Route::get('/home', function () {
    return view('backend.pages.dashboard');
});
