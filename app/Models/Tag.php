<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string $name
 * @property string $isActive
 * @property int $created_time
 * @property int $updated_time
 * @property-read mixed $created_time_format
 * @property-read mixed $updated_time_format
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Blog> $tag
 * @property-read int|null $tag_count
 * @method static \Database\Factories\TagFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedTime($value)
 * @mixin \Eloquent
 */
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
