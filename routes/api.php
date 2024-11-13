<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\Leadform\LeadformController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;

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

//Api Menu
Route::get('/list-menu', [MenuController::class, 'listMenu'])->name('listMenu');
//End Api Menu

//Api Products 
Route::prefix('products')->group(function () {
    Route::get('/', [ProductsController::class, 'index']);
    Route::get('/{id}', [ProductsController::class, 'detail']);
    Route::post('/store', [ProductsController::class, 'handleCreate']);
    Route::post('/{id}', [ProductsController::class, 'handleEdit']);
    Route::delete('/{id}', [ProductsController::class, 'handleDelete']);
});
//End Api Products

Route::get('/items', [ItemController::class, 'index']);
Route::prefix('/item')->group(function () {
    Route::get('/{id}', [ItemController::class, 'show']);
    Route::post('/store', [ItemController::class, 'store']);
    Route::put('/{id}', [ItemController::class, 'update']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
});

//Auth
Route::post('/register', [AuthController::class, 'handleRegister']);
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::post('/logout', [AuthController::class, 'handleLogout']);
Route::post('/forgot-password', [AuthController::class, 'forgotpassword']);
//End Auth

//Role 
Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'getList']);
    Route::get('{id}', [RoleController::class, 'detail']);
});
//End Role 

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
