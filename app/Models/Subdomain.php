<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdomain extends Model
{
    use HasFactory;

    protected $table    = 'subdomain';
    protected $fillable = ['id', 'name', 'link', 'active'];
    public  $timestamps = false;

    public function user(){
        return $this->belongsToMany(User::class, 'subdomain_user', 'subdomain_id', 'user_id');
    }
}
