<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class page extends Model
{
    use HasFactory;
    protected $table='pages';
    protected $fillable=['title','content'];

    public function pageHistory()
    {
        return $this->hasOne(pageHistory::class);
    }
}
