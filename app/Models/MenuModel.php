<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    use HasFactory;

    protected $table    = 'bo_menu';
    protected $fillable = ['id', 'parent_id', 'name', 'keyword', 'icon', 'order', 'active'];
}
