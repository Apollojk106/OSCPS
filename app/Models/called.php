<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class called extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'priority',
        'recalled',
        'type_problem',
        'name',
        'email',
        'local',
        'environment',
    ];
}
