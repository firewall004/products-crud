<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register'])->name('api.register');
Route::post('login/admin', [AuthController::class, 'loginAsAdmin']);
Route::post('login/vendor', [AuthController::class, 'loginAsVendor']);

Route::group(['middleware' => ['auth:sanctum', 'type.admin']], function () {
	Route::get('test', [AuthController::class, 'test']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
	Route::get('logout', [AuthController::class, 'logout']);
});
