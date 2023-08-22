<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\UserAuthenticationController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/login', [UserAuthenticationController::class, 'login']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [UserAuthenticationController::class, 'logout']);
    //Category Controller
	Route::controller(CategoryController::class)->group(function (){
		Route::get('/categories','index')->name('category.index');
		Route::post('/category/store','store')->name('category.store');
		Route::post('/category/update/{category}','update')->name('category.update');
		Route::get('/category/delete/{category}', 'delete')->name('category.delete');
	});