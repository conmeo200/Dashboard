<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

trait RedisTrait
{
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
