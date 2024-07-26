<?php

namespace App\Http\Controllers\Api;

use App\Service\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProductController extends BaseApiController
{
    public $products;

    public function __construct(Products $products)
    {
        $connect = Redis::connection();

        $connect->client()->rPush();
        $this->products = $products;
    }

    public function index(Request $request)
    {
        return response()->json($this->products->getListProducts());
    }
}
