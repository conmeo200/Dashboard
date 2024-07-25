<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubdomainUser extends Model
{
    use HasFactory;

    protected $table    = 'subdomain_user';
    protected $fillable = ['id', 'user_id', 'subdomain_id'];
}
