<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table    = 'products';
    protected $fillable = ['id', 'name', 'price', 'images', 'type_product_id'];
    public  $timestamps = false;

    public function typeProduct()
    {
        return $this->belongsTo(TypeProduct::class, 'id', 'type_product_id');
    }
}
