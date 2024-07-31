<?php

namespace App\Http\Controllers\Api;

use App\Service\Products;
use App\Traits\RedisTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseApiController
{
    use RedisTrait;
    public $products;

    public function __construct(Products $products)
    {
        $connect = Redis::connection();

        $this->products = $products;
    }

    public function index(Request $request)
    {
        $params['page'] = $request->has('page') && $request->get('page') > 0  ? $request->get('page') : 1;

        return response()->json($this->products->getListProducts($params));
    }

    public function detail(Request $request, $id)
    {
        if (empty($id) || !is_numeric($id)) return $this->sendError('Data Invalid');

        return $this->sendResponse($this->products->findFirstProductByID($id));
    }
}
