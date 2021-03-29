<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

// class Usuarios extends Model 
class Usuarios extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,HasFactory;

    protected $table ='usuarios';
    protected $fillable=['name','career','email','password','profile','jobTitle','skills','jobSummary'];
   

    // public function profile()
    // {
    //     return $this->hasOne(profile::class);
    // }
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

