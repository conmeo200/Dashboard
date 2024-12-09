<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $appends = ['created_time_format', 'updated_time_format'];
    public    $timestamps      = false;

    public function subdomain(){
        return $this->belongsToMany(Subdomain::class, 'subdomain_user', 'subdomain_id', 'user_id');
    }

    // public function getCreatedTimeFormatAttribute()
    // {
    //     return Carbon::createFromTimestamp($this->created_at)->format('d/m/Y H:i');  
    // }

    // public function getUpdatedTimeFormatAttribute()
    // {
    //     return Carbon::createFromTimestamp($this->updated_at)->format('d/m/Y H:i');  
    // }
}
