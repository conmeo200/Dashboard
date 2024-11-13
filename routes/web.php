<?php

use App\Models\MongoDB\LogActivity;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\LogsRepositories\Logs;
use Carbon\Carbon;
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

Route::get('/test-components', function () {
    return view('pdf_view');
});

Route::get('/test-mysql', function () {
    $model = Product::query()->get()->toArray();
    dd($model);
});

Route::get('/test-redis', function () {
    $redis = Redis::connection();
    dd($redis);
    $redis->set('test', 'Hello Redis');
    return $redis->get('test');
});

Route::get('/test-mongodb', function () {
    //$collection = LogActivity::get();
    $logs = new Logs();
    $logs1 = new LogActivity();
    $result = $logs->insert(['name' => 'Test MongoDB5', 'timestamp' => Carbon::now()->timestamp]);
    //$result = $logs1->insert(['name' => 'Test MongoDB4', 'timestamp' => Carbon::now()->timestamp]);
    // $document = $collection->where('name', 'Test MongoDB')->first();
    return response()->json($logs->getAllLogs());
});

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
