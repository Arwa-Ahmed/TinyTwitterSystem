<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers;
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
Route::middleware('guest:api')->group(function () {
    Route::post('register', [Auth\RegisterController::class, 'register']);
    Route::post('login', [Auth\LoginController::class, 'login'])->middleware("throttle:5,0.6");
    //custom throttle exception message in Exceptions->Handler.php
});

Route::get('usersPdfReport', [Controllers\UserController::class, 'UsersReport']);

Route::middleware('auth:api')->group(function() {
    Route::prefix('user')->group(function () {
        Route::post('/createTweet', [Controllers\TweetController::class, 'create']);
        Route::post('/follow/{id}', [Controllers\FollowerController::class, 'follow']);
        Route::post('/unFollow/{id}', [Controllers\FollowerController::class, 'unFollow']);
    });
});
