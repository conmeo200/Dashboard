<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth
Route::post('/register', [AuthController::class, 'handleRegister']);
Route::post('/login', [AuthController::class, 'handleLogin']);

Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'handleLogout']);
});
// End Auth

// Page
Route::group(['prefix' => 'tag'], function () {
    Route::get('/', [TagsController::class, 'index']);
    Route::post('/create', [TagsController::class, 'create']);
    Route::get('/{id}', [TagsController::class, 'detail']);
    Route::post('/{id}', [TagsController::class, 'update']);
    Route::delete('/{id}', [TagsController::class, 'delete']);
});

Route::group(['prefix' => 'blog'], function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::post('/create', [BlogController::class, 'create']);
    Route::get('/{id}', [BlogController::class, 'detail']);
    Route::post('/{id}', [BlogController::class, 'update']);
    Route::delete('/{id}', [BlogController::class, 'delete']);
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/create', [UserController::class, 'create']);
    Route::get('/{id}', [UserController::class, 'detail']);
    Route::post('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'delete']);
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/create', [ProductController::class, 'create']);
    Route::get('/{id}', [ProductController::class, 'detail']);
    Route::post('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
});

Route::group(['prefix' => 'order'], function () {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('/create', [OrderController::class, 'create']);
    Route::get('/{id}', [OrderController::class, 'detail']);
    Route::post('/{id}', [OrderController::class, 'update']);
    Route::delete('/{id}', [OrderController::class, 'delete']);
});
// End Page