<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

trait RedisTrait
{
    public $service;

    public function __construct()
    {
        $this->service = Redis::connection()->client();
    }

    public function setCacheListData($key, $callback)
    {
        $cachedData = $this->service->lrange($key, 0, -1);

        if ($cachedData) {
            return json_decode($cachedData, true);
        } else {
            dd($callback);
            $this->service->rpush(json_encode($callback));

            return $callback;
        }
    }

    public function setHashCacheListData($key, $callback= null)
    {
        try {
            $data       = [];
            $cachedData = $this->service->hGetAll($key);

            if ($cachedData) {
                $data = $cachedData;
            } else {
                if (empty($callback)) $data = [];

                foreach ($callback as $item) {
                    $this->service->hMSet("type_product:{$item['id']}", $item);
                }

                $data = $callback;
            }

            return $data;
        } catch (\Exception $exception) {
            return 'Could not handle cache: ' . $exception->getMessage() . ", Line : " . $exception->getLine();
        }
    }

    public function hmSetOrGetData($cache_key, $data_post = [])
    {
        try {
            $cachedData = $this->service->hGetAll($cache_key);
            $data       = [];

            if ($cachedData) {
                $data = $cachedData;
            } else {
                if (empty($data_post)) $data = [];
                else {
                    $this->service->hMSet($cache_key, $data_post);

                    $data = $data_post;
                }
            }

            return $data;

        } catch (\Exception $exception) {
            return 'Could not handle cache hmSetOrGet : ' . $exception->getMessage() . ", Line : " . $exception->getLine();
        }
    }

    public function setOrGetListData($cache_key, $list_data = [])
    {
        try {
            if ($this->service->exists($cache_key)) {
                return array_map(function ($item) {
                    return json_decode($item, true);
                }, $this->service->lRange($cache_key, 0, -1));
            } else {
                if (empty($list_data)) return [];

                foreach ($list_data as $item) {
                    $this->service->rpush($cache_key, json_encode($item));
                }

                return $list_data;
            }

        } catch (\Exception $exception) {
            return 'Could not handle cache setOrGetListData : ' . $exception->getMessage() . ", Line : " . $exception->getLine();
        }
    }

    public function getOrSetCache($key, $callback = null, $minutes = 60)
    {
        try {

            if (Cache::has($key)) {
                return Cache::get($key);
            }

            if (is_null($callback)) {
                return Cache::get($key);
            }

            return Cache::remember($key, $minutes, $callback);
        } catch (\Exception $e) {
            return 'Could not handle cache: ' . $e->getMessage();
        }
    }

    public function setCache($key, $callback = null, $minutes = 60)
    {
        try {
            if (Cache::has($key) || is_null($callback)) {
                return Cache::get($key);
            }

            return Cache::remember($key, $minutes, $callback);
        } catch (\Exception $e) {
            return "Could not handle set cache: {$key}, Error " . $e->getMessage();
        }
    }

    public function getCache($key, $minutes = 60)
    {
        try {
            if (Cache::has($key)) {
                return Cache::get($key);
            }

            return [];
        } catch (\Exception $e) {
            return "Could not handle get cache: {$key}, Error " . $e->getMessage();
        }
    }

    public function delCache($key, $minutes = 60)
    {
        try {
            if (Cache::has($key)) {
                return Cache::forget($key);
            }

            return [];
        } catch (\Exception $e) {
            return "Could not handle forget cache: {$key}, Error " . $e->getMessage();
        }
    }
}
