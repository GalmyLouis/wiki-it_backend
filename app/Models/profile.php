<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $table='profiles';
    protected $fillable=['title','skills','jobSummary'];

    public function usuario()
    {
        return $this->belongsTo(Usuarios::class);
    }
}
