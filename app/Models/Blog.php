<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = [
        'id',
        'title',
        'post', 
        'slug', 
        'image', 
        'meta_description',
        'views',
        'post_exceprt',
        'created_time',
        'updated_time',
        'user_id',
    ];

    public function user() {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'blog_category', 'blog_id', 'category_id', 'id', 'id');
    }

    public function tag() {
        return $this->belongsToMany(Tag::class, 'blog_tag', 'blog_id', 'tag_id', 'id', 'id');
    }
}
