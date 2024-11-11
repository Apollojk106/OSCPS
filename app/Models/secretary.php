<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class secretary extends Model
{
    protected $fillable = [
        'name',
        'email',
        'entry_time',
        'exit_time',
    ];

    protected $dates = ['entry_time', 'exit_time'];

    protected $casts = [
        'entry_time' => 'datetime:H:i',
        'exit_time' => 'datetime:H:i',
    ];

    public function getEntryTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i'); // Formato 24h sem os segundos
    }

    public function getExitTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i'); // Formato 24h sem os segundos
    }

    public function setEntryTimeAttribute($value)
    {
        $this->attributes['entry_time'] = Carbon::parse($value)->format('H:i:s');
    }

    public function setExitTimeAttribute($value)
    {
        $this->attributes['exit_time'] = Carbon::parse($value)->format('H:i:s');
    }
}
