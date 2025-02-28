<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Blog
 *
 * @property int $id
 * @property string $title
 * @property string $post
 * @property string $slug
 * @property string $image
 * @property string $meta_description
 * @property string $views
 * @property string $post_exceprt
 * @property int $created_time
 * @property int $updated_time
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read mixed $created_time_format
 * @property-read mixed $updated_time_format
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tag
 * @property-read int|null $tag_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\BlogFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCreatedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog wherePost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog wherePostExceprt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUpdatedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereViews($value)
 * @mixin \Eloquent
 */
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
