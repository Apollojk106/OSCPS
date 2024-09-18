<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class called extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'date_open',
        'date_end',
        'status', 
        'priority', 
        'type_problem',
        'name'
    ];
}
