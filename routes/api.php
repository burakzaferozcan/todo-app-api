<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TodoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("auth")->group(function () {
    Route::post("/register", [UserController::class, 'register']);
    Route::post("/login", [UserController::class, 'login']);
    Route::get("/logout", [UserController::class, 'logout']);
    Route::get("/myProfile", [UserController::class, 'myProfile']);
});
Route::prefix("todo")->middleware("auth:api")->group(function () {
    Route::get("/list", [TodoController::class, 'index']);
    Route::post("/store", [TodoController::class, 'store']);
    Route::get("/{id}/get", [TodoController::class, 'getById']);
    Route::put("/{id}/update", [TodoController::class, 'update']);
    Route::delete("/{id}/delete", [TodoController::class, 'destroy']);
});

Route::prefix("auth")->middleware("auth:api")->group(function () {
    Route::get("/myProfile", [UserController::class, 'myProfile']);
    Route::post("/update/image", [UserController::class, 'updateUserImage']);

});
