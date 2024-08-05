<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;

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
Route::get('/article', [ProductController::class, 'index']);
Route::get('/article/{id}', [ProductController::class, 'articleDetail']);
Route::get('clear-cache', [ProductController::class, 'clearAllCache']);
Route::get('delete-cache/{key}', [ProductController::class, 'delKeyCache']);
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
