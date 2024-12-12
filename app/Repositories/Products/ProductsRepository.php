<?php
namespace App\Repositories\Products;

use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\RedisService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductsRepository extends BaseRepository
{
    const MODEL       = 'product';
    const KEY_LIST_ID = 'product_id_list';

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

    public function getAllProduct($params = []) 
    {
        try {
            $redisService = new RedisService();
            $member       = 'id';
            $key          = self::MODEL;
            $orderBy      = 'id';
            
            // Store Data To Redis
            $existsCache = $redisService->exists(self::KEY_LIST_ID);
            
            if ($existsCache) $products = $redisService->listSorted($key, [], $orderBy);
            else {
                $products = parent::orderBy($orderBy, 'DESC')->get()->toArray();

                $redisService->listSorted($key, $products, $orderBy, $member);
            }

            return $products;
        } catch (\Exception $ex) {
            Log::error("Get data list product error: {$ex->getMessage()}");

            return [];
        }
    }
}

