<?php

use App\Http\Controllers\Backend\Auth\LoginController;
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

Route::name('admin.')->group(function () {

    Route::get('/login',            LoginController::class)->name('login.show');

    // Route::view('/dashboard',       'backend.pages.dashboard')->name('dashboard');
});