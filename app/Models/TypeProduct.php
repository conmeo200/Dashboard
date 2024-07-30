<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    use HasFactory;
    protected $table    = 'type_product';
    protected $fillable = ['id', 'name', 'keyword', 'order', 'active'];
    public $timestamps  = false;
}
