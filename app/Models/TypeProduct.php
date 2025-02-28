<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TypeProduct
 *
 * @property int $id
 * @property string $name
 * @property string $keyword
 * @property int $order
 * @property string $active
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $product
 * @property-read int|null $product_count
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct whereKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TypeProduct whereOrder($value)
 * @mixin \Eloquent
 */
class TypeProduct extends Model
{
    use HasFactory;
    protected $table    = 'type_product';
    protected $fillable = ['id', 'name', 'keyword', 'order', 'active'];
    public $timestamps  = false;

    public function product()
    {
        return $this->hasMany(Product::class, 'type_product_id', 'id');
    }
}
