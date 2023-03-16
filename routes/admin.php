<?php

use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\LogoutController;
use App\Http\Controllers\Backend\DashboardController;
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


Route::group(['as' => 'admin.'], function () {

    Route::get('/login',            LoginController::class)->name('login.show');

    Route::group(['middleware' => 'auth:admin'], function () {

        Route::get('/dashboard',       DashboardController::class)->name('dashboard');

        Route::get('/logout',           LogoutController::class)->name('logout');
    });
});