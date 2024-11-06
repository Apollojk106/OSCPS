<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class secretary extends Model
{
    // Define os campos que podem ser preenchidos no banco de dados
    protected $fillable = [
        'name',
        'email',
        'entry_time',
        'exit_time',
    ];

    // Defina os campos que devem ser convertidos para objetos Carbon
    protected $dates = ['entry_time', 'exit_time'];

    // Acesso e formatação para o campo entry_time
    public function getEntryTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i'); // Formato 24h sem os segundos
    }

    // Acesso e formatação para o campo exit_time
    public function getExitTimeAttribute($value)
    {
        return Carbon::parse($value)->format('H:i'); // Formato 24h sem os segundos
    }

    // Caso você precise armazenar os horários no banco em um formato específico
    public function setEntryTimeAttribute($value)
    {
        $this->attributes['entry_time'] = Carbon::parse($value)->format('H:i:s');
    }

    public function setExitTimeAttribute($value)
    {
        $this->attributes['exit_time'] = Carbon::parse($value)->format('H:i:s');
    }
}
