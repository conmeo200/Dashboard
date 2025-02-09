<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseApiController;
use App\Jobs\EmailJob;
use App\Jobs\NoticationsJob;
use App\Jobs\OrdersJob;
use App\Service\Notification\NotificationManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoticationController extends BaseApiController
{
    protected $noticationService;

    public function __construct(NotificationManager $noticationService)
    {
        $this->noticationService = $noticationService;
    }

    public function createOrder(Request $request) 
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_name'     => ['required', 'string', 'min:1', 'max:255'],
                'product_quantity' => ['required', 'numeric']
            ]);

            if ($validator->fails()) {
                return $this->sendError($validator->errors()->toArray());
            }

            $dataPost             = $validator->validated();
            $dataPost['order_id'] = random_int(1, 1000);

            dispatch(new OrdersJob($dataPost))->onQueue('order_queue');
            dispatch(new EmailJob($dataPost))->onQueue('email_queue');
            dispatch(new NoticationsJob($dataPost))->onQueue('notification_queue');

            return $this->sendResponse([                
                'messages' => "Create Order ID {$dataPost['order_id']} Success."
            ]);
        } catch (\Exception $ex) {
            return json_encode($ex->getMessage());
        }
    }
}
