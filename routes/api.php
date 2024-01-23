<?php

use App\Http\Controllers\Auth\UserAuthenticationController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
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
Route::middleware('auth:api')->group(function () {
    // Logout
    Route::get('/logout', [UserAuthenticationController::class, 'logout']);
    // Category Route
    Route::controller(CategoryController::class)->prefix('category')->group(function () {
        Route::get('list', 'index');
        Route::get('subcategory', 'subcategory');
        Route::get('details/{category}', 'details');
        Route::post('store', 'store');
        Route::put('update/{category}', 'update');
    });
    // Brand Route
    Route::controller(BrandController::class)->prefix('brand')->group(function () {
        Route::get('list', 'index');
        Route::get('details/{brand}', 'details');
        Route::post('store', 'store');
        Route::put('update/{brand}', 'update');
    });
    // Unit Route
    Route::controller(UnitController::class)->prefix('unit')->group(function () {
        Route::get('list', 'index');
        Route::get('details/{unit}', 'details');
        Route::post('store', 'store');
        Route::put('update/{unit}', 'update');
    });
});
