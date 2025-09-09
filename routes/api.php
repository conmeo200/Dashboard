<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TagsController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PermissonsController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PayPalController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\CustomersController;
use App\Http\Controllers\NoticationController;

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
Route::post('/login', [AuthController::class, 'handleLogin'])->name('login');
// Route::post('/test-notication', [NoticationController::class, 'createOrder']);
//Init 
Route::get('/menus', [MenuController::class, 'initMenu']);
//End
Route::middleware(['auth:sanctum', 'check.role'])->group(function () {
    // Log out
    Route::post('/logout', [AuthController::class, 'handleLogout']);
    // End

    // Paypal 

    Route::prefix('paypal')->group(function () {
        Route::post('create-payment', [PayPalController::class, 'createPayment']);
        Route::post('execute-payment', [PayPalController::class, 'executePayment']);
    });

    Route::prefix('payment')->group(function () {
        Route::post('success', [PayPalController::class, 'createPayment']);
        Route::post('cancel', [PayPalController::class, 'executePayment']);
    });

    // Permissions
    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', [PermissonsController::class, 'index']);
        Route::post('/create', [PermissonsController::class, 'create']);
        Route::get('/{id}', [PermissonsController::class, 'detail']);
        Route::post('/{id}', [PermissonsController::class, 'update']);
        Route::delete('/{id}', [PermissonsController::class, 'delete']);
    });
    // End Permissions

    // Customers
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', [CustomersController::class, 'index']);
        Route::post('/create', [CustomersController::class, 'create']);
        Route::get('/{id}', [CustomersController::class, 'detail']);
        Route::post('/{id}', [CustomersController::class, 'update']);
        Route::delete('/{id}', [CustomersController::class, 'delete']);
    });
    // End Customers

    // Roles
    Route::group(['prefix' => 'role', 'middleware' => ['permission:view roles,api']], function () {
        Route::get('/', [RoleController::class, 'index']); // Không cần middleware lặp lại
        Route::post('/create', [RoleController::class, 'create'])->middleware('permission:create roles,api');
        Route::get('/{id}', [RoleController::class, 'detail']);
        Route::post('/{id}', [RoleController::class, 'update'])->middleware('permission:update roles,api');
        Route::delete('/{id}', [RoleController::class, 'delete'])->middleware('permission:delete roles,api');
    });
    
    // End Roles

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
});
// End Auth