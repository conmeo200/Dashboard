<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\MenuModel
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $keyword
 * @property string $type
 * @property string $icon
 * @property int $order
 * @property string $active
 * @method static \Illuminate\Database\Eloquent\Builder|MenuModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|MenuModel whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuModel whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuModel whereKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuModel whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuModel whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MenuModel whereType($value)
 * @mixin \Eloquent
 */
class MenuModel extends Model
{
    use HasFactory;

    protected $table    = 'bo_menu';
    protected $fillable = ['id', 'parent_id', 'name', 'keyword', 'type', 'icon', 'order', 'active'];
}
