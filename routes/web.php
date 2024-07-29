<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/test-redis', function () {
    $redis = Redis::connection();
    $redis->set('test', 'Hello Redis');
    return $redis->get('test');
});

Route::get('/test-mongodb', function () {
    $collection = DB::connection('mongodb')->collection('test');
    $collection->insert(['name' => 'Test MongoDB']);
    $document = $collection->where('name', 'Test MongoDB')->first();
    return response()->json($document);
});

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
