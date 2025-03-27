<?php 
namespace App\Service;

use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use Redirect;

class PayPalService
{
    protected $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    /**
     * Tạo thanh toán
     */
    public function createPayment($total, $currency, $description, $returnUrl, $cancelUrl)
    {
        try {
            $payer = new Payer();
            $payer->setPaymentMethod("paypal");

            $item = new Item();
            $item->setName('Watch')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($total);

            $item_list = new ItemList();
            $item_list->setItems([$item]);

            $amount = new \PayPal\Api\Amount();
            $amount->setTotal($total)->setCurrency($currency);

            $transaction = new Transaction();
                $transaction
                    ->setAmount($amount)
                    ->setDescription($description);

            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl($returnUrl)->setCancelUrl($cancelUrl);

            $payment = new Payment();
            $payment->setIntent("sale")
                    ->setPayer($payer)                   
                    ->setRedirectUrls($redirectUrls)
                    ->setTransactions([$transaction]);
        
            $payment->create($this->apiContext);
            $url_redirect = '';

            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {                
                    $url_redirect = $link->getHref();
                    
                    break;
                }
            }
            
            if (empty($url_redirect)) return response()->json(["error" => "Không tìm thấy URL thanh toán."], 400);
    
            return [
                "payment_id"   => $payment->getId(),
                "approval_url" => $url_redirect
            ];
        } catch (\Exception $e) {
            throw new \Exception("Lỗi khi tạo thanh toán: " . $e->getMessage());
        }
    }

    /**
     * Xử lý thanh toán sau khi người dùng hoàn thành trên PayPal
     */
    public function executePayment($paymentId, $payerId)
    {
        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);
            return $result; // Kết quả giao dịch
        } catch (\Exception $e) {
            throw new \Exception("Lỗi khi xử lý thanh toán: " . $e->getMessage());
        }
    }

    /**
     * Kiểm tra trạng thái thanh toán
     */
    public function getPaymentDetails($paymentId)
    {
        try {
            $payment = Payment::get($paymentId, $this->apiContext);
            return $payment;
        } catch (\Exception $e) {
            throw new \Exception("Không thể lấy thông tin thanh toán: " . $e->getMessage());
        }
    }
}
