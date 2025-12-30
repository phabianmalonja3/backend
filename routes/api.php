<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/auth/login',[AuthController::class,'login']);
Route::post('/auth/logout',[AuthController::class,'logoutFun']);
Route::get("/categories",[App\Http\Controllers\CategoryController::class,'index']);
Route::resource("/galleries",App\Http\Controllers\GalleryController::class);
Route::resource("/destinations",App\Http\Controllers\DestinationController::class);
Route::resource("/heroes",App\Http\Controllers\HeroController::class);
