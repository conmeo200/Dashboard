<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

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
}
