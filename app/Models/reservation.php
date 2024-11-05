<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    use HasFactory;

    protected $fillable = [   
        'name_user',   
        'name_email',
        'class',
        'date',
        'time',
        'integrantes',
    ];

    protected $casts = [
        'date' => 'date', // Cast para data
        'time' => 'time', // Cast para hora
    ];
}
