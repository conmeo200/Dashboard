<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table   = 'bookings';
    protected $appends = ['created_time_format', 'updated_time_format'];

    protected $fillable = [
        'id',
        'booking_uuid',
        'user_id', 
        'staff_id',
        'service_id', 
        'booking_date',
        'start_time',
        'end_time',
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
