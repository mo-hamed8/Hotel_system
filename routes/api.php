<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\userRoleController;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix("v1")->group(function(){
    Route::post("login",[AuthController::class,"login"]);
    Route::post("register",[AuthController::class,"register"]);
    Route::post("logout",[AuthController::class,"logout"])->middleware("auth:sanctum");
    Route::post("assignRole",[userRoleController::class,"assignRoleToUser"])->middleware("auth:sanctum");
    Route::delete("removeRoleFromUser",[userRoleController::class,"removeRoleFromUser"])->middleware("auth:sanctum");

    Route::apiResource("bookings",BookingController::class)->middleware("auth:sanctum");
    Route::apiResource("rooms",RoomController::class)->middleware("auth:sanctum");
    Route::apiResource("clients",ClientController::class)->middleware("auth:sanctum");
});
