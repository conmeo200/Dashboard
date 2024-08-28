<?php
namespace App\Repositories\Products;

use App\Models\Product;
use App\Repositories\BaseRepository;

interface ProductsInterface
{
    public function findProducts($params = []);
}

