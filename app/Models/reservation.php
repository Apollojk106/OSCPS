<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    use HasFactory;

    protected $fillable = [   
        'RM',   
        'name_email',
        'status',
        'class',
        'date',
        'time',
        'integrantes',
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
