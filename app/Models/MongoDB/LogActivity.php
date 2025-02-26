<?php

namespace App\Models\MongoDB;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class LogActivity extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'logs';
    // protected $fillable   = ['name', 'email'];
    private static $instance = [];

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
