<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class court_reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_user',
        'description',
        'date_order',
    ];
}
