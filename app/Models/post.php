<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $table='posts';
    protected $fillable=['title','content','votes'];

    public function comments(){
        return $this->hasMany(comment::class);
    }
}
