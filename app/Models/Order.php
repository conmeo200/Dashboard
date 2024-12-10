<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table    = 'orders';
    public $timestamps  = false;
    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'product_name',
        'product_price',
        'quantity',
        'total',
        'status',
        'created_time',
    ];

    public function user(){
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function products(){
        return $this->hasMany(Product::class, 'id', 'product_id');
    }
}
