<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table           = 'blogs';
    public    $timestamps      = false;
    public   static $instance  = [];
    protected $appends         = ['created_time_format', 'updated_time_format'];

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

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getCreatedTimeFormatAttribute()
    {
        return Carbon::createFromTimestamp($this->created_time)->format('d/m/Y H:i');  
    }

    public function getUpdatedTimeFormatAttribute()
    {
        return Carbon::createFromTimestamp($this->updated_time)->format('d/m/Y H:i');  
    }
    
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'blog_category', 'blog_id', 'category_id', 'id', 'id');
    }

    public function tag() {
        return $this->belongsToMany(Tag::class, 'blog_tag', 'blog_id', 'tag_id', 'id', 'id');
    }
}
