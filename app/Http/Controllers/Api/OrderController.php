<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Service\Notification\NotificationManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class OrderController extends BaseApiController
{
    public $notification;

    public function __construct(NotificationManager $notification)
    {
        $this->notification = $notification;
    }

    public function index(Request $request) 
    {
        return $this->sendPaginationResponse(Order::query()->paginate(10));
    }

    public function detail($id) 
    {
        return $this->sendResponse(Order::query()->where(['id' => $id])->first());
    }

    public function update(Request $request, $id) 
    {
        return $this->sendResponse(Order::query()->where(['id' => $id])->update($request->all()));    
    }

    public function delete($id) 
    {
        return $this->sendResponse(Order::query()->where(['id' => $id])->delete());    
    }
    
    public function create(Request $request) 
    {
        $id       = 2; // auth()->user()->user_id
        $dataPost = $request->all();
        $product  = Product::query()->where(['id' => $id])->first();

        $order = [
            'user_id'       => 2,
            'product_id'    => $product->id,
            'product_name'  => $product->name,
            'product_price' => $product->price,
            'quantity'      => $id,
            'total'         => $product->price * $id,
            'status'        => 'Pending',
            'retry_count'   => 0,
            'created_time'  => now()->timestamp,
            'type' => ['sms', 'email']
        ];

        //$result = Order::query()->create($order);

        if (!empty($order)) {
            $this->notification->publishMessage($order);

            return $this->sendResponse($order);
        }
        else $this->sendError('Insert Order Fail');
    }
}
