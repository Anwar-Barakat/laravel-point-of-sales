<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordRestLinkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Section\SectionController;
use App\Http\Controllers\Admin\Setting\AdminChangePasswordController;
use App\Http\Controllers\Admin\Setting\AdminProfileController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Store\StoreController;
use App\Http\Controllers\Admin\Treasury\TreasuryController;
use App\Http\Controllers\Admin\Treasury\TreasuryDelivery\TreasuryDeliveryController;
use App\Http\Livewire\Admin\Unit\IndexUnit;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

define('PAGINATION_COUNT', 10);

Route::group(
    [
        'prefix'        => LaravelLocalization::setLocale(),
        'middleware'    => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/login',                        [LoginController::class, 'show'])->name('login.show');
            Route::post('/login',                       [LoginController::class, 'login'])->name('login');

            Route::get('/password/forget',              [PasswordRestLinkController::class, 'create'])->name('forget.password.form');
            Route::post('/password/forget',             [PasswordRestLinkController::class, 'store'])->name('forget.password.store');

            Route::get('/reset/password/{token}',       [NewPasswordController::class, 'create'])->name('password.reset.link');
            Route::post('reset-password',               [NewPasswordController::class, 'store'])->name('password.reset');

            Route::group(['middleware' => 'admin'], function () {
                Route::get('/logout',                       LogoutController::class)->name('logout');
                Route::get('/dashboard',                    DashboardController::class)->name('dashboard');


                //!_______________________
                //! Setting
                //!_______________________
                Route::resource('/settings',                SettingController::class)->only(['index']);
                Route::get('/profile',                      AdminProfileController::class)->name('setting.profile');
                Route::get('/change-password',              AdminChangePasswordController::class)->name('setting.change-password');

                //!_______________________
                //! Treasuries
                //!_______________________
                Route::resource('treasuries',               TreasuryController::class)->only(['index', 'create', 'show', 'edit']);
                Route::resource('treasury-deliveries',      TreasuryDeliveryController::class)->only(['store', 'destroy']);

                //!_______________________
                //! Sections
                //!_______________________
                Route::resource('sections',                 SectionController::class)->except(['create', 'show', 'edit']);

                //!_______________________
                //! Categories
                //!_______________________
                Route::resource('categories',               CategoryController::class)->except(['store', 'show', 'update']);

                //!_______________________
                //! Stoes
                //!_______________________
                Route::resource('stores',                   StoreController::class)->except(['create', 'show', 'edit']);


                //!_______________________
                //! Units
                //!_______________________
                Route::get('units',                         IndexUnit::class)->name('units.index');
            });
        });
    }
);
