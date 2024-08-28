<?php

namespace App\Http\Controllers\Api;

use App\Jobs\RegisterUserJob;
use App\Repositories\Products\ProductsInterface;
use App\Repositories\Products\ProductsRepository;
use Illuminate\Http\Request;

class LogController extends BaseApiController
{

    public $products;
    public $productsRepository;

    public function __construct(ProductsInterface $products, ProductsRepository $productsRepository)
    {
        $this->products = $products;
        $this->productsRepository = $productsRepository;
    }

    public function listLog(Request $request)
    {
            $this->products->findProducts();
            $this->productsRepository->create([]);
    }
}
