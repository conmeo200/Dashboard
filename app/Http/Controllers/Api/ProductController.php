<?php

namespace App\Http\Controllers\Api;

use App\Service\Products;
use App\Traits\RedisTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;


class ProductController extends BaseApiController
{
    use RedisTrait;
    public $products;

    public function __construct(Products $products)
    {
        $connect = Redis::connection();

        $this->products = $products;
    }

    public function articleDetail($id) {
        try {
            $redis           = app()->make('redis');
            $articleKey      = 'article:' . $id;
            $articleViewsKey = 'articleViews';

            // Kiểm tra nếu bài viết đã có trong tập hợp sorted set
            if ($redis->zScore($articleViewsKey, $articleKey)) {
                // Sử dụng pipeline để tăng đồng thời giá trị trong sorted set và key
                $redis->pipeline(function ($pipe) use ($articleKey) {
                    $pipe->zIncrBy('articleViews', 1, $articleKey);
                    $pipe->incr($articleKey . ':views');
                });
            } else {
                // Tăng giá trị và thêm vào sorted set nếu chưa có
                $views = $redis->incr($articleKey . ':views');
                $redis->zIncrBy($articleViewsKey, $views, $articleKey);
            }

            // Lấy danh sách bài viết theo số lượt xem
            $listArticle = [];
            foreach ($redis->zRange($articleViewsKey, 0, -1) as $item) {
                $listArticle[$item] = $redis->get($item . ':views');
            }

            return $listArticle;
        } catch (\Exception $exception) {
            dd("Cache Article Error : {$exception->getMessage()}");
        }
    }

    public function index(Request $request)
    {
        try {
            $redis           = app()->make('redis');
            $articleViewsKey = 'articleViews';

            $listArticle = [];
            foreach ($redis->zRange($articleViewsKey, 0, -1) as $item) {
                $listArticle[$item] = $redis->get($item . ':views');
            }

            return $listArticle;
        } catch (\Exception $exception) {
            dd("Cache Article Error : {$exception->getMessage()}");
        }
    }

    public function detail(Request $request, $id)
    {
        if (empty($id) || !is_numeric($id)) return $this->sendError('Data Invalid');

        return $this->sendResponse($this->products->findFirstProductByID($id));
    }

    public function clearAllCache()
    {
        $redis = app()->make('redis');
        $redis->flushall();

        return response()->json(['message' => 'All cache cleared from all databases']);
    }

    public function delKeyCache($key)
    {
        $redis    = app()->make('redis');
        $keyCache = $key;

        $redis->del($key);

        return response()->json(['message' => "Delete Key {$keyCache}"]);
    }
}
