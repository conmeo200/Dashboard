<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nails extends Model
{
    use HasFactory;

    protected $table   = 'nails';
    protected $appends = ['created_time_format', 'updated_time_format'];

    protected $fillable = [
        'id',
        'name',
        'description', 
        'image_url', 
        'price', 
        'status',
        'created_at',
        'updated_at',
    ];

    public function getCreatedTimeFormatAttribute()
    {
        return Carbon::createFromTimestamp($this->created_at)->format('d/m/Y H:i');  
    }

    public function getUpdatedTimeFormatAttribute()
    {
        return Carbon::createFromTimestamp($this->updated_at)->format('d/m/Y H:i');  
    }
}
