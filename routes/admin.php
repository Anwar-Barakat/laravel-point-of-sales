<?php

use App\Http\Controllers\Admin\Account\AccountType\AccountTypeController;
use App\Http\Controllers\Admin\Account\FinancialAccount\AccountController;
use App\Http\Controllers\Admin\Account\VendorCategory\VendorCategoryController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordRestLinkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeberalSetting\Admin\AdminController;
use App\Http\Controllers\Admin\GeneralSetting\Setting\AdminChangePasswordController;
use App\Http\Controllers\Admin\GeneralSetting\Setting\AdminProfileController;
use App\Http\Controllers\Admin\GeneralSetting\Setting\SettingController;
use App\Http\Controllers\Admin\GeneralSetting\Treasury\TreasuryController;
use App\Http\Controllers\Admin\GeneralSetting\Treasury\TreasuryDelivery\TreasuryDeliveryController;
use App\Http\Controllers\Admin\Stock\Category\CategoryController;
use App\Http\Controllers\Admin\Stock\Customer\CustomerController;
use App\Http\Controllers\Admin\Stock\Item\ItemController;
use App\Http\Controllers\Admin\Stock\Section\SectionController;
use App\Http\Controllers\Admin\Stock\Store\StoreController;
use App\Http\Controllers\Admin\Stock\Unit\UnitController;
use App\Http\Controllers\Admin\Stock\Vendor\VendorController;
use App\Http\Controllers\Admin\StockMovement\OrderController;
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

                //_______________________
                // Setting
                //_______________________
                Route::resource('/settings',                SettingController::class)->only(['index']);
                Route::get('/profile',                      AdminProfileController::class)->name('setting.profile');
                Route::get('/change-password',              AdminChangePasswordController::class)->name('setting.change-password');

                //_______________________
                // Treasuries
                //_______________________
                Route::resource('treasuries',               TreasuryController::class)->only(['index', 'create', 'show', 'edit']);
                Route::resource('treasury-deliveries',      TreasuryDeliveryController::class)->only(['store', 'destroy']);

                //_______________________
                // Admins
                //_______________________
                Route::resource('admins',                   AdminController::class);


                //_______________________
                // Sections
                //_______________________
                Route::resource('sections',                 SectionController::class)->except(['create', 'show', 'edit']);

                //_______________________
                // Categories
                //_______________________
                Route::resource('categories',               CategoryController::class)->except(['store', 'show', 'update']);

                //_______________________
                // Stoes
                //_______________________
                Route::resource('stores',                   StoreController::class)->except(['create', 'show', 'edit']);

                //_______________________
                // Units
                //_______________________
                Route::resource('units',                    UnitController::class)->except(['show']);

                //_______________________
                // Items
                //_______________________
                Route::resource('items',                    ItemController::class)->except(['store', 'update']);

                //_______________________
                // Customers
                //_______________________
                Route::resource('customers',                CustomerController::class);

                //_______________________
                // Vendors
                //_______________________
                Route::resource('vendors',                  VendorController::class);



                //_______________________
                // Account types
                //_______________________
                Route::resource('account-types',            AccountTypeController::class)->only(['index']);

                //_______________________
                // Financial Accounts
                //_______________________
                Route::resource('accounts',                 AccountController::class)->except(['store', 'update']);



                //_______________________
                // Orders
                //_______________________
                Route::resource('orders',                   OrderController::class);
            });
        });
    }
);
