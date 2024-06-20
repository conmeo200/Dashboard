<?php

namespace App\Http\Controllers;

use App\Service\Stripe;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $stripe = new Stripe();
    }
}
