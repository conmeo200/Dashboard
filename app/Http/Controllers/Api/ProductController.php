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

        $connect->client()->rPush();
        $this->products = $products;
    }

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page' => ['numeric']
        ]);

        if ($validator->fails()) $this->sendValidator($validator->errors()->toArray());

        $dataPost = $validator->validated();

        $params['per_page'] = $dataPost['page'] > 0  ? $dataPost['page'] : 1;

        return response()->json($this->products->getListProducts($params));
    }
}
