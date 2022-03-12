<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserSignUpController;
use App\Http\Controllers\Api\UserWelcomeController;
use App\Http\Middleware\Api\VerifyToken;

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

Route::group(['prefix' => '/v1'], function () {
    Route::post('/user/sign-up', [UserSignUpController::class, 'post'])->middleware(VerifyToken::class);
    Route::get('/user/welcome', [UserWelcomeController::class, 'get'])->middleware(VerifyToken::class);
});
