<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\BlogController;

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
