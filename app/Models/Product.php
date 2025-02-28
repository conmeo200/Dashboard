<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property string $price
 * @property string $currency
 * @property string|null $images
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $type_product_id
 * @property-read mixed $created_time_format
 * @property-read mixed $updated_time_format
 * @property-read \App\Models\TypeProduct|null $typeProduct
 * @method static \Database\Factories\ProductFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereTypeProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;
    
    protected $table           = 'products';
    protected $fillable        = ['id', 'name', 'price', 'images', 'type_product_id'];
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
