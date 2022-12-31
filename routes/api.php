<?php

use App\Http\Controllers\NavigationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Public routes
Route::get('/settings', [SettingController::class, 'getAllSettings']);
Route::post('/settings/update', [SettingController::class, 'updateSetting']);
Route::get('/get-menu', [NavigationController::class, 'getInitialMenu']);

//Admin routes
Route::middleware('auth:sanctum') -> group(function () {
    Route::post('/create-product', [ProductController::class, 'createProduct']);
    Route::post('/get-all-products', [ProductController::class, 'getAllProducts']);
});