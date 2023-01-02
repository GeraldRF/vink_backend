<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'welcome to vink api 2.0';
});

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum') -> group(function () {
    Route::get('/get-current-user', [UserController::class, 'getLoginUser']);
    Route::get('/logout', [UserController::class, 'logout']);
});