<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Role extends Model
{
    use HasFactory;

    protected $table      = 'roles';
    protected $primaryKey = 'id';
    
    protected $fillable   = [
        'id',
        'name',
        'guard_name',
        'created_at',
        'updated_at'
    ];

    public function menus() 
    {
        return $this->belongsToMany(MenuModel::class, 'menu_roles', 'role_id', 'menu_id');
    }
}
