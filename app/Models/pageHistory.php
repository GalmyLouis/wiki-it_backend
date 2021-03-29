<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pageHistory extends Model
{
    use HasFactory;
    protected $table='page_histories';
    protected $fillable=['author','date','content'];



    public function page()
    {
        return $this->belongsTo(page::class);
    }
}
