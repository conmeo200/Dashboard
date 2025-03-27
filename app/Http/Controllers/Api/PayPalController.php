<?php

namespace App\Http\Controllers\Api;

use App\Service\PayPalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PayPalController extends BaseApiController
{
    protected $paypalService;

    public function __construct(PayPalService $paypalService)
    {
        $this->paypalService = $paypalService;
    }

    /**
     * Endpoint để tạo thanh toán
     */
    public function createPayment(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'total'       => 'required|numeric',
                'currency'    => 'required|string|max:3',
                'description' => 'required|string',
            ]);
            
            // if ($validator->fails()) {
            //     return $this->sendError($validator->errors()->toArray());
            // }

            $dataPost = $validator->validated();

            $total        = $dataPost['total'] ?? 10;
            $currency     = $dataPost['currency'] ?? 'USD';
            $description  = $dataPost['description'] ?? 'tEST cURRENCY';
            $returnUrl    = config('app.url') . 'payment-success';
            $cancelUrl    = config('app.url') . 'payment-cancel';

            $dataRespone = $this->paypalService->createPayment($total, $currency, $description, $returnUrl, $cancelUrl);        

            return $this->sendResponse($dataRespone);
        } catch (\Exception $e) {
            Log::error("Create Payment Error : {$e->getMessage()}");

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Endpoint để xử lý thanh toán sau khi người dùng hoàn thành trên PayPal
     */
    public function executePayment(Request $request)
    {
        $request->validate([
            'paymentId' => 'required|string',
            'PayerID'   => 'required|string',
        ]);

        $paymentId = $request->input('paymentId');
        $payerId   = $request->input('PayerID');

        try {
            $result = $this->paypalService->executePayment($paymentId, $payerId);
            return response()->json(['message' => 'Payment successful', 'details' => $result], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function cancel(Request $request) {Log::info(json_encode("Payment Cancel , data respone" . $request->all()));}
    public function success(Request $request) {Log::info(json_encode("Payment Success , data respone" . $request->all()));}
}
