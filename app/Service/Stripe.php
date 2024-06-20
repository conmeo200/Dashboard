<?php
namespace App\Service;

class Stripe {

    public function add() {
        try {
            $stripe = new \Stripe\StripeClient(env('SECRET_KEY_STRIPE'));

            $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price' => '12',
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => 'https://example.com/success',
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
