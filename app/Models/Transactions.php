<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $table    = 'transactions';
    public  $timestamps = false;
    protected $fillable = [
            'id',
            'transaction_id',
            'name',
            'email',
            'amount',
            'currency',
            'created_at',
            'updated_at'
    ];
}
