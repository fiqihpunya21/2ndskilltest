<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
/*
Route::middleware('auth:api')->get('/user', function(Request $request){
    return $request->user();
});
*/

Route::get('/', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class,'authenticate'])->middleware('guest');

Route::post('logout', LogoutController::class)->name('logout')->middleware('auth');

Route::get('/dashboard',[DashboardController::class,'index'])->middleware('auth');
//Route::get('/dashboard/user',[DashboardController::class,'user'])->middleware('auth');
//Route::get('/dashboard/category',[DashboardController::class,'category'])->middleware('auth');

Route::get('/user',[UserController::class,'index'])->name('user')->middleware('auth');
Route::post('/user',[UserController::class, 'store'])->middleware('auth');
Route::get('/user/edit/{id}',[UserController::class, 'edit'])->middleware('auth');
Route::post('/user/update',[UserController::class,'update'])->middleware('auth');
Route::get('/user/destroy/{id}',[UserController::class, 'destroy'])->middleware('auth');

Route::get('/category',[CategoryController::class,'index'])->name('category')->middleware('auth');
Route::post('/category',[CategoryController::class, 'store'])->middleware('auth');
Route::get('/category/edit/{id}',[CategoryController::class, 'edit'])->middleware('auth');
Route::post('/category/update',[CategoryController::class,'update'])->middleware('auth');
Route::get('/category/destroy/{id}',[CategoryController::class, 'destroy'])->middleware('auth');
//Route::apiResource('api/category',ApiController::class);

/*
Route::get('/api',[ApiController::class, 'index']);
Route::get('/api/{id}',[ApiController::class, 'show']);
Route::post('/api',[ApiController::class, 'store']);
Route::put('/api/{id}',[ApiController::class, 'update']);
Route::delete('/api/{id}',[ApiController::class, 'destroy']);
*/