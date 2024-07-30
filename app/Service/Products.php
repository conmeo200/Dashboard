<?php
namespace App\Service;

use App\Models\Product;
use App\Traits\RedisTrait;

class Products
{
    use RedisTrait;

    public function getListProducts($params = [])
    {
        $page = $params['page'];
        $data = Product::query()
            ->orderBy('id')
            ->get()
            ->toArray();

        return $this->setCacheListData('products', $data);
    }
}
