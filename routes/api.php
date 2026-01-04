<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('/users',UserController::class );
Route::post('/auth/login',[AuthController::class,'login']);
Route::post('/auth/logout',[AuthController::class,'logoutFun']);
Route::get("/categories",[App\Http\Controllers\CategoryController::class,'index']);
Route::resource("/galleries",App\Http\Controllers\GalleryController::class);
Route::resource("/destinations",App\Http\Controllers\DestinationController::class);
Route::resource("/heroes",App\Http\Controllers\HeroController::class);
Route::resource("/options",App\Http\Controllers\PackageOptionController::class);
Route::resource("/packages",App\Http\Controllers\TourPackageController::class);
Route::resource("/events",App\Http\Controllers\EventController::class);
Route::resource("/locations",App\Http\Controllers\LocationController::class);
