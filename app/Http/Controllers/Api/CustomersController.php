<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MongoDB\Customer;
use App\Repositories\Customes\CustomersRepository;
use Illuminate\Http\Request;

class CustomersController extends BaseApiController
{
    public $customers;

    public function __construct(CustomersRepository $customerRSP)
    {
        $this->customers = $customerRSP;
    }

    public function index() 
    {
        return $this->sendResponse($this->customers->list());
    }

    public function createCustomer(Request $request) 
    {
        $customers = Customer::all();

        return $this->sendResponse($customers->toArray());
    }
}
