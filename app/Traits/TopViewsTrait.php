<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

trait TopViewsTrait
{
    public $redis;

    public function __construct()
    {
        $this->redis = app()->make('redis');
    }

    public function getList($keys_views)
    {
        try {
            $articleViewsKey = !empty($keys_views) ? $keys_views : 'articleViews';

            $listArticle = [];
            foreach ($this->redis->zRange($articleViewsKey, 0, -1) as $item) {
                $listArticle[$item] = $this->redis->get($item . ':views');
            }

            return $listArticle;
        } catch (\Exception $exception) {
            return ['status' => false, 'messages' => "Cache Top Views GetList Error : {$exception->getMessage()}"];
        }
    }

    public function detail($id, $key, $keys_views)
    {
        try {
            $articleKey      = $key . $id;
            $articleViewsKey = !empty($keys_views) ? $keys_views : 'articleViews';

            // Kiểm tra nếu bài viết đã có trong tập hợp sorted set
            if ($this->redis->zScore($articleViewsKey, $articleKey)) {
                // Sử dụng pipeline để tăng đồng thời giá trị trong sorted set và key
                $this->redis->pipeline(function ($pipe) use ($articleKey) {
                    $pipe->zIncrBy('articleViews', 1, $articleKey);
                    $pipe->incr($articleKey . ':views');
                });
            } else {
                // Tăng giá trị và thêm vào sorted set nếu chưa có
                $views = $this->redis->incr($articleKey . ':views');
                $this->redis->zIncrBy($articleViewsKey, $views, $articleKey);
            }

            return $this->redis->get($articleKey . ':views');
        } catch (\Exception $exception) {
            return ['status' => false, 'messages' => "Cache Top Views Detail Error : {$exception->getMessage()}"];
        }
    }

    public function del($key, $keys_views)
    {
        try {
            $keyCache = $key;
            $result   = $this->redis->Zrem($keys_views, $key);

            if ($result) {
                return ['status' => true, 'messages' => "Delete Cache Key : {$keyCache}, Successfully"];
            } else {
                return ['status' => false, 'messages' => "Delete Cache Key : {$keyCache}, Fail"];
            }
        } catch (\Exception $exception) {
            return ['status' => false, 'messages' => "Cache Top Views Delete Error : {$exception->getMessage()}"];
        }
    }
}
