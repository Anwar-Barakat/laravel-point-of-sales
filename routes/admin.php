<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\DashboardController;
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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',            [LoginController::class, 'show'])->name('login.show');
    Route::post('/login',           [LoginController::class, 'login'])->name('login');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/logout',           LogoutController::class)->name('logout');
        Route::get('/dashboard',        DashboardController::class)->name('dashboard');
    });
});
