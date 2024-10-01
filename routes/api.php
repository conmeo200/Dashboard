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


Route::get('/list-menu', [MenuController::class, 'listMenu'])->name('listMenu');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/download-pdf', [MenuController::class, 'downloadPDF']);
Route::get('/article', [ArticleController::class, 'index']);
Route::get('/article/{id}', [ArticleController::class, 'articleDetail']);

Route::get('clear-cache', [ArticleController::class, 'clearAllCache']);
Route::get('delete-cache/{key}', [ArticleController::class, 'delKeyCache']);
Route::post('lead-form', [LeadformController::class, 'create']);

Route::get('products', [ProductsController::class, 'index']);
Route::prefix('/product')->group(function () {
    Route::get('/{id}', [ProductsController::class, 'detail']);
    Route::post('/store', [ProductsController::class, 'handleCreate']);
    Route::post('/{id}', [ProductsController::class, 'handleEdit']);
    Route::delete('/{id}', [ProductsController::class, 'handleDelete']);
});


Route::get('/items', [ItemController::class, 'index']);
Route::prefix('/item')->group(function () {
    Route::get('/{id}', [ItemController::class, 'show']);
    Route::post('/store', [ItemController::class, 'store']);
    Route::put('/{id}', [ItemController::class, 'update']);
    Route::delete('/{id}', [ItemController::class, 'destroy']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/send-otp', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'getList']);
    Route::get('{id}', [RoleController::class, 'detail']);
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
