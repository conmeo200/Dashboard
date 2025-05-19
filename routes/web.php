<?php

use App\Jobs\EmailJob;
use App\Jobs\NoticationsJob;
use App\Jobs\OrdersJob;
use App\Models\MongoDB\LogActivity;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\LogsRepositories\Logs;
use App\Service\Notification\NotificationManager;
use App\Service\RabbitmqService\RabbitMQService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PayPalController;


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

Route::prefix('paypal')->group(function () {
    Route::get('create-payment', [PayPalController::class, 'createPayment']);
    Route::post('execute-payment', [PayPalController::class, 'executePayment']);
});

Route::get('/comsumer-order', function () {
    //dispatch(new \App\Jobs\OrdersJob(['order_id' => 200, 'product_name' => 'Product A']))->onQueue('email_queue');

    $rmq = new RabbitMQService();

    // Create Exchange
    // $rmq->createExchange('order_exchange', 'direct'); // Hoặc 'fanout', 'topic'

    // Binding Queue To Exchange
    // $rmq->createQueue('order_queue');
    // $rmq->bindQueueToExchange('order_queue', 'order_exchange', 'order.created');

    // Send Message to Exchange
    $rmq->publishMessage('order_exchange', 'order.created', ['order_id' => 123, 'status' => 'pending']);

    $rmq->close();
});
Route::get('/consumer-notification', function () {
    $rmq = new RabbitMQService();

    // Create Exchange
    //$rmq->createExchange('notification_exchange', 'direct'); // Hoặc 'fanout', 'topic'

    // Binding Queue To Exchange
    //$rmq->createQueue('notification_queue');
    //$rmq->bindQueueToExchange('notification_queue', 'notification_exchange', 'notification.notification');

    // Send Message to Exchange
    $rmq->publishMessage(
        'notification_exchange',
        'notification.notification',
        [
            'type'         => '',
            'notification' => 123,
            'messages'     => 'Notification Create Order ID #123 Successful !'
        ]
    );

    $rmq->close();
});


Route::get('/test-mysql', function () {
    $model = Product::query()->get()->toArray();
    dd($model);
});

Route::get('/test-redis', function () {
    $redis = Redis::connection();
    $redis->set('test1', 'Hello Redis');
    return $redis->get('test1');
});

Route::get('/publish-notification', function () {
    $redis   = app('redis'); // Lấy Redis instance
    $channel = 'notifications'; // Tên kênh Redis

    $message = [
        'title'     => 'Hello World',
        'body'      => 'This is a test notification from Redis Pub/Sub',
        'timestamp' => now()->toDateTimeString(),
    ];

    // Gửi (publish) message đến Redis
    $redis->publish($channel, json_encode($message));

    return response()->json(['status' => 'Notification published']);
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
