<?php
namespace App\Service;

use App\Models\Product;
use App\Traits\RedisTrait;

class Products
{
    use RedisTrait;

    public $redis;
    public $cacheKey;

    public function __construct()
    {
        $this->redis    = app()->make('redis');
        $this->cacheKey = 'type_product';
    }

    public function getListProducts($params = [])
    {

        return Product::query()
            ->orderBy('id')
            ->get()
            ->toArray();
    }

    public function findFirstProductByID($id)
    {
        $key      = $this->cacheKey . ":{$id}";
        $getCache =  $this->hmSetOrGetData($key);
        $result   =  [];

        if (!empty($getCache)) $result = $getCache;
        else {
            $data = Product::query()
                ->where(['id' => $id])
                ->first();

            $this->hmSetOrGetData($key, $data);

            $result =  $data;
        }

        return $result;
    }
}
