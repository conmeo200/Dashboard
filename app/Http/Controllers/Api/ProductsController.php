<?php

namespace App\Http\Controllers\Api;

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
        return $this->sendPaginationResponse($this->products->getListProducts());
    }

    public function detail(Request $request, $id)
    {
        return $this->sendPaginationResponse($this->products->getListProducts());
    }

    public function handleCreate(Request $request)
    {
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
