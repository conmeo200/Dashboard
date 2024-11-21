<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['id', 'name', 'isActive', 'created_time', 'updated_time'];

    public function blogs() {
        return $this->belongsToMany(Blog::class, 'blog_category', 'blog_id', 'category_id', 'id', 'id');
    }
}
