<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table      = 'tags';
    protected $fillable   = ['id', 'name', 'isActive', 'created_time', 'updated_time'];
    public    $timestamps = false;
    
    public function tag() {
        return $this->belongsToMany(Blog::class, 'blog_tag', 'blog_id', 'tag_id', 'id', 'id');
    }
}
