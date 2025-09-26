<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table   = 'payments';
    protected $appends = ['created_time_format', 'updated_time_format'];

    protected $fillable = [
        'id',
        'booking_id',
        'payment_uuid',
        'amount', 
        'payment_method', 
        'status', 
        'transaction_id',
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
