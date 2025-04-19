<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\RoomController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user-profile', [AuthController::class, 'userProfile']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'buildings'
], function ($router) {
    Route::get('/', [BuildingController::class, 'index']);
    Route::post('/', [BuildingController::class, 'store']);
    Route::get('/{building}', [BuildingController::class, 'show']);
    Route::put('/{building}', [BuildingController::class, 'update']);
    Route::delete('/{building}', [BuildingController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'rooms'
], function ($router) {
    Route::get('/', [RoomController::class, 'index']);
    Route::post('/', [RoomController::class, 'store']);
    Route::get('/{room}', [RoomController::class, 'show']);
    Route::put('/{room}', [RoomController::class, 'update']);
    Route::delete('/{room}', [RoomController::class, 'destroy']);
}); 