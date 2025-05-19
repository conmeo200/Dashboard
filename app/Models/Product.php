<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;
    
    protected $table           = 'products';
    protected $fillable        = ['id', 'name', 'price','currency', 'images', 'type_product_id', 'created_at', 'updated_at'];
    public    $timestamps      = false;
    public    static $instance = [];
    protected $appends         = ['created_time_format', 'updated_time_format'];

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function typeProduct()
    {
        return $this->belongsTo(TypeProduct::class, 'id', 'type_product_id');
    }

    public function getCreatedTimeFormatAttribute()
    {
        return Carbon::createFromTimestamp($this->created_at)->format('d/m/Y H:i');  
    }

    public function getUpdatedTimeFormatAttribute()
    {
        return Carbon::createFromTimestamp($this->updated_at)->format('d/m/Y H:i');  
    }
}
