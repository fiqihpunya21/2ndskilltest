<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('category',ApiController::class)->middleware('auth:sanctum');
Route::post('/login',LoginController::class);
Route::post('/logout',LogoutController::class)->middleware('auth:sanctum');