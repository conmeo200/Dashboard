<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subdomain
 *
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string $active
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|Subdomain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subdomain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subdomain query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subdomain whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subdomain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subdomain whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subdomain whereName($value)
 * @mixin \Eloquent
 */
class Subdomain extends Model
{
    use HasFactory;

    protected $table    = 'subdomain';
    protected $fillable = ['id', 'name', 'link', 'active'];
    public  $timestamps = false;

    public function user(){
        return $this->belongsToMany(User::class, 'subdomain_user', 'subdomain_id', 'user_id');
    }
}
