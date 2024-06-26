<?php

namespace App\Models\MongoDB;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Students extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'user';
    protected $fillable   = ['name', 'email', 'password', 'status'];
}
