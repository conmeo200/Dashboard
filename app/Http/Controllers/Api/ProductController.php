<?php

namespace App\Http\Controllers\Api;

use App\Service\Products;
use App\Traits\RedisTrait;
use Illuminate\Http\Request;

class ProductController extends BaseApiController
{
    use RedisTrait;
    public $products;

    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    public function index(Request $request)
    {
        return response()->json($this->products->getListProducts());
    }
}
