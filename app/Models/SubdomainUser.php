<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SubdomainUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $subdomain_id
 * @method static \Illuminate\Database\Eloquent\Builder|SubdomainUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubdomainUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubdomainUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubdomainUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubdomainUser whereSubdomainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubdomainUser whereUserId($value)
 * @mixin \Eloquent
 */
class SubdomainUser extends Model
{
    use HasFactory;

    protected $table    = 'subdomain_user';
    protected $fillable = ['id', 'user_id', 'subdomain_id'];
}
