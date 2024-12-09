<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table           = 'tags';
    protected $fillable        = ['id', 'name', 'isActive', 'created_time', 'updated_time'];
    public    $timestamps      = false;
    public   static $instance  = [];
    protected $appends = ['created_time_format', 'updated_time_format'];

    public function getCreatedTimeFormatAttribute()
    {
        return Carbon::createFromTimestamp($this->created_time)->format('d/m/Y H:i');  
    }

    public function getUpdatedTimeFormatAttribute()
    {
        return Carbon::createFromTimestamp($this->updated_time)->format('d/m/Y H:i');  
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function tag() {
        return $this->belongsToMany(Blog::class, 'blog_tag', 'blog_id', 'tag_id', 'id', 'id');
    }
}
