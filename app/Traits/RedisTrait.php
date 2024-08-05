<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

trait RedisTrait
{
    public $redis;

    public function __construct()
    {
        $this->redis = app()->make('redis');
    }
}
