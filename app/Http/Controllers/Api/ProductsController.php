<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Service\Products;
use App\Traits\RedisTrait;
use Illuminate\Http\Request;


class ProductsController extends BaseApiController
{
    use RedisTrait;
    public $products;

    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    public function index(Request $request)
    {
        return $this->sendResponse($this->products->getListProducts());
    }

    public function detail(Request $request, $id)
    {
        $model = Product::query()->where(['id' => $id])->first();

        if (!$model) return $this->sendError("Data ID : {$id} Not Found !");

        return $this->sendResponse($model);
    }

    public function handleCreate(Request $request)
    {
        dd($request->all());
        return $this->sendPaginationResponse($this->products->getListProducts());
    }

    public function handleEdit(Request $request)
    {
        return $this->sendPaginationResponse($this->products->getListProducts());
    }

    public function handleDelete(Request $request)
    {
        return $this->sendPaginationResponse($this->products->getListProducts());
    }
}
