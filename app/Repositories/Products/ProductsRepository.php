<?php
namespace App\Repositories\Products;

use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ProductsRepository extends BaseRepository implements ProductsInterface
{
    public function getModel() {
        return Product::class;
    }

    public function create123(array $data) {
        return DB::transaction(function () use ($data) {
            $user = parent::create([
                'customerNumber'   => $data['customerNumber'],
                'customerName'     => $data['customerName'],
                'contactLastName'  => $data['contactLastName'],
                'contactFirstName' => $data['contactFirstName'],
            ]);
            return $user;
        });
    }

    public function findProducts($params = []) {
        return Product::query();
    }
}

