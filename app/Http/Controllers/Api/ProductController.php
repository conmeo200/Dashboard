<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Products\ProductsRepository;
use Illuminate\Http\Request;

class ProductController extends BaseApiController
{
    protected $productRsp;

    public function __construct(ProductsRepository $productRsp)
    {
        $this->productRsp = $productRsp;
    }

    public function index(Request $request) 
    {
        return $this->sendPaginationArrayResponse($this->productRsp->getAllProduct($request->all()));    

    }

    public function create(Request $request) {
        
    }

    public function detail($id) 
    {
        
    }

    public function update(Request $request, $id) {
        
    }

    public function delete($id) {
        
    }
}
