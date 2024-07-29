<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\BlogsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function () {
    Route::get('/', [UsersController::class, 'index']);
    Route::get('{id}', [UsersController::class, 'show']);
    Route::post('/', [UsersController::class, 'store']);
    Route::put('{id}', [UsersController::class, 'update']);
    Route::delete('{id}', [UsersController::class, 'destroy']);
});

Route::prefix('blogs')->group(function () {
    Route::get('/', [BlogsController::class, 'index']);
    Route::get('{id}', [BlogsController::class, 'show']);
    Route::post('/', [BlogsController::class, 'store']);
    Route::put('{id}', [BlogsController::class, 'update']);
    Route::delete('{id}', [BlogsController::class, 'destroy']);
});
