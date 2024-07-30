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

        return $this->getOrSetCache('products_' . $page, function () {
            return Product::query()
                ->orderBy('id')
                ->paginate(10)
                ->toArray();
        }, 60);
    }
}
