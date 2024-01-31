<?php

use App\Http\Controllers\Auth\UserAuthenticationController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authentication Route
Route::controller(UserAuthenticationController::class)->group(function () {
    Route::post('login', 'login');
});
// Settings Route
Route::get('settings', [SettingsController::class, 'index']);
Route::middleware('auth:api')->group(function () {
    // Logout
    Route::get('logout', [UserAuthenticationController::class, 'logout']);
    // Brand Route
    Route::controller(BrandController::class)->prefix('brand')->group(function () {
        Route::get('list', 'index');
        Route::get('details/{brand}', 'details');
        Route::post('store', 'store');
        Route::put('update/{brand}', 'update');
        Route::delete('destroy/{brand}', 'destroy');
    });
    // Category Route
    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('list', 'index');
        Route::get('subcategory', 'subcategory');
        Route::get('details/{category}', 'details');
        Route::post('store', 'store');
        Route::put('update/{category}', 'update');
        Route::delete('destroy/{category}', 'destroy');
    });
    // Currency Route
    Route::controller(CurrencyController::class)->prefix('currency')->group(function () {
        Route::get('list', 'index');
        Route::get('details/{currency}', 'details');
        Route::post('store', 'store');
        Route::put('update/{currency}', 'update');
        Route::delete('destroy/{currency}', 'destroy');
    });
    // Customer Route
    Route::controller(CustomerController::class)->prefix('customer')->group(function () {
        Route::get('list', 'index');
        Route::get('details/{customer}', 'details');
        Route::post('store', 'store');
        Route::put('update/{customer}', 'update');
        Route::delete('destroy/{customer}', 'destroy');
    });
    // Dashboard Route
    Route::get('dashboard', [DashboardController::class, 'index']);
    // Product Route
    Route::controller(ProductController::class)->prefix('product')->group(function () {
        Route::get('list', 'index');
        Route::get('details/{product}', 'details');
        Route::post('store', 'store');
        Route::put('update/{product}', 'update');
        Route::delete('destroy/{product}', 'destroy');
    });
    // Purchase Route
    Route::controller(PurchaseController::class)->prefix('purchase')->group(function () {
        Route::get('list', 'index');
        Route::get('details/{purchase}', 'details');
        Route::post('store', 'store');
        Route::put('update/{purchase}', 'update');
        Route::delete('destroy/{purchase}', 'destroy');
    });
    // Sale Route
    Route::controller(SaleController::class)->prefix('sale')->group(function () {
        Route::get('list', 'index');
        Route::get('details/{sale}', 'details');
        Route::post('store', 'store');
        Route::put('update/{sale}', 'update');
        Route::delete('destroy/{sale}', 'destroy');
    });
    // Settings Route
    Route::put('settings/update', [SettingsController::class, 'update']);
    // Supplier Route
    Route::controller(SupplierController::class)->prefix('supplier')->group(function () {
        Route::get('list', 'index');
        Route::get('details/{supplier}', 'details');
        Route::post('store', 'store');
        Route::put('update/{supplier}', 'update');
        Route::delete('destroy/{supplier}', 'destroy');
    });
    // Tax Route
    Route::controller(TaxController::class)->prefix('tax')->group(function () {
        Route::get('list', 'index');
        Route::get('details/{tax}', 'details');
        Route::post('store', 'store');
        Route::put('update/{tax}', 'update');
        Route::delete('destroy/{tax}', 'destroy');
    });
    // Unit Route
    Route::controller(UnitController::class)->prefix('unit')->group(function () {
        Route::get('list', 'index');
        Route::get('details/{unit}', 'details');
        Route::post('store', 'store');
        Route::put('update/{unit}', 'update');
        Route::delete('destroy/{unit}', 'destroy');
    });
    // Profile Update Route
    Route::controller(UserController::class)->group(function () {
        Route::put('profile-update', 'profileUpdate');
        Route::put('password-update', 'passwordUpdate');
    });
});
