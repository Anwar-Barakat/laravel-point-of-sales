<?php

use App\Http\Controllers\Admin\Account\AccountType\AccountTypeController;
use App\Http\Controllers\Admin\Account\CollectTransaction\CollectTransactionController;
use App\Http\Controllers\Admin\Account\ExchangeTransaction\ExchangeTransactionController;
use App\Http\Controllers\Admin\Account\FinancialAccount\AccountController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordRestLinkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Report\Customer\CustomerReportController;
use App\Http\Controllers\Admin\Report\Delegate\DelegateReportController;
use App\Http\Controllers\Admin\Report\Vendor\VendorReportController;
use App\Http\Controllers\Admin\Setting\Admin\AdminController;
use App\Http\Controllers\Admin\Setting\AdminChangePasswordController;
use App\Http\Controllers\Admin\Setting\AdminProfileController;
use App\Http\Controllers\Admin\Setting\CompanyController;
use App\Http\Controllers\Admin\Setting\Treasury\TreasuryController;
use App\Http\Controllers\Admin\Setting\Treasury\TreasuryDelivery\TreasuryDeliveryController;
use App\Http\Controllers\Admin\Stock\Category\CategoryController;
use App\Http\Controllers\Admin\Stock\Customer\CustomerController;
use App\Http\Controllers\Admin\Stock\Delegate\DelegateController;
use App\Http\Controllers\Admin\Stock\Item\ItemController;
use App\Http\Controllers\Admin\Stock\Section\SectionController;
use App\Http\Controllers\Admin\Stock\Store\StoreController;
use App\Http\Controllers\Admin\Stock\Unit\UnitController;
use App\Http\Controllers\Admin\Stock\Vendor\VendorController;
use App\Http\Controllers\Admin\WarehouseTransaction\GeneralOrderReturn\GeneralOrderReturnController;
use App\Http\Controllers\Admin\WarehouseTransaction\GeneralSaleReturn\GeneralSaleReturnController;
use App\Http\Controllers\Admin\WarehouseTransaction\Order\OrderController;
use App\Http\Controllers\Admin\WarehouseTransaction\Order\OrderInvoiceController;
use App\Http\Controllers\Admin\WarehouseTransaction\Sale\SaleController;
use App\Http\Controllers\Admin\WarehouseTransaction\Sale\SaleInvoiceController;
use App\Http\Controllers\Admin\WarehouseTransaction\Sale\SaleInvoicePdfController;
use App\Http\Controllers\Admin\WarehouseTransaction\Shift\ShiftController;
use App\Http\Controllers\ServiceController;
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

define('CUSTOM_PAGINATION', 10);

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
                Route::fallback(fn () =>  redirect()->route('admin.dashboard'));

                Route::get('/logout',                           LogoutController::class)->name('logout');
                Route::get('/dashboard',                        DashboardController::class)->name('dashboard');

                //_______________________
                // Setting
                //_______________________
                Route::get('/settings',                         CompanyController::class)->name('setting.company');
                Route::get('/profile',                          AdminProfileController::class)->name('setting.profile');
                Route::get('/change-password',                  AdminChangePasswordController::class)->name('setting.change-password');

                //_______________________
                // Treasuries
                //_______________________
                Route::resource('treasuries',                   TreasuryController::class)->only(['index', 'create', 'show', 'edit']);
                Route::resource('treasury-deliveries',          TreasuryDeliveryController::class)->only(['store', 'destroy']);

                //_______________________
                // Admins
                //_______________________
                Route::resource('admins',                       AdminController::class);

                //_______________________
                // Services
                //_______________________
                Route::resource('services',                     ServiceController::class)->only('index', 'create', 'edit', 'destroy');


                //_______________________
                // Sections
                //_______________________
                Route::resource('sections',                     SectionController::class)->except(['store', 'update', 'destroy']);

                //_______________________
                // Categories
                //_______________________
                Route::resource('categories',                   CategoryController::class)->except(['store', 'show', 'update']);

                //_______________________
                // Stoes
                //_______________________
                Route::resource('stores',                       StoreController::class)->except(['create', 'show', 'edit']);

                //_______________________
                // Units
                //_______________________
                Route::resource('units',                        UnitController::class)->except(['show']);

                //_______________________
                // Items
                //_______________________
                Route::resource('items',                        ItemController::class)->except(['store', 'update']);

                //_______________________
                // Customers
                //_______________________
                Route::resource('customers',                    CustomerController::class)->except('store', 'update');

                //_______________________
                // Vendors
                //_______________________
                Route::resource('vendors',                      VendorController::class)->except('store', 'update');

                //_______________________
                // Delegates
                //_______________________
                Route::resource('delegates',                    DelegateController::class)->except('store', 'update');


                //_______________________
                // Account types
                //_______________________
                Route::resource('account-types',                AccountTypeController::class)->only(['index']);

                //_______________________
                // Accounts
                //_______________________
                Route::resource('accounts',                     AccountController::class)->except(['store', 'update']);

                //_______________________
                // collect/exhange transaction
                //_______________________
                Route::get('collect-transactions',              CollectTransactionController::class)->name('collect-transactions');
                Route::get('exchange-transactions',             ExchangeTransactionController::class)->name('exchange-transactions');


                //_______________________
                // Orders
                //_______________________
                Route::resource('orders',                       OrderController::class)->except('store', 'update');
                Route::resource('general-order-returns',        GeneralOrderReturnController::class);
                Route::get('order-invoice/{order}',             OrderInvoiceController::class)->name('orders.invoice');

                //_______________________
                // sales
                //_______________________
                Route::resource('sales',                        SaleController::class);
                Route::resource('general-sale-returns',         GeneralSaleReturnController::class);
                Route::get('sale-invoice/{sale}',               SaleInvoiceController::class)->name('sales.invoice');

                //_______________________
                // Shifts
                //_______________________
                Route::resource('shifts',                       ShiftController::class)->except('store', 'update');

                //_______________________
                // item balances
                //_______________________
                Route::view('item-balances',                    'admin.warehouse-transactions.item-balamces.index')->name('item.balances');


                //_______________________
                // reports
                //_______________________
                Route::get('vendors-reports',                   VendorReportController::class)->name('vendors.reports');
                Route::get('customers-reports',                 CustomerReportController::class)->name('customers.reports');
                Route::get('delegates-reports',                 DelegateReportController::class)->name('delegates.reports');
            });
        });
    }
);


Route::group(['middleware' => 'admin'], function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/sale-invoice-pdf/{sale}',          SaleInvoicePdfController::class)->name('sales.invoice.pdf');
        Route::get('/sale-invoice-pdf/{sale}',          SaleInvoicePdfController::class)->name('sales.invoice.pdf');
    });
});
