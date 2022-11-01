<?php

use App\Http\Controllers\Api\MobileApi\AuthController;
use App\Http\Controllers\api\WebApi\WebAuthController;
use Illuminate\Http\Request;
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

//MobileApi
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('verify', [AuthController::class, 'verify_mail']);
Route::post('resend', [AuthController::class, 'send_mail']);
Route::post('forget_password', [AuthController::class, 'forget_password']);
Route::post('update_password', [AuthController::class, 'update_password']);

//WebApi
Route::post('web_login', [WebAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('get_user', [AuthController::class, 'user_info']);
    Route::get('logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});