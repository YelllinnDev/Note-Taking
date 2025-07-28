<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\NoteController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post("register", [AuthController::class, "register"]);



Route::post('v1/register', [AuthController::class, 'register']);
Route::post('v1/login', [AuthController::class, 'login']);


Route::middleware('auth:api')
    ->prefix('v1/notes')
    ->controller(NoteController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'detail');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });