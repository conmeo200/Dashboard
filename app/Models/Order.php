<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string $product_name
 * @property float $product_price
 * @property int $quantity
 * @property float $total
 * @property string $status
 * @property int $created_time
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
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
