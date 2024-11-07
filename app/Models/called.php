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
        'roof',
        'environment',
    ];

    const TYPE_PROBLEM = [
        '1' => 'Elétrico',
        '2' => 'Hidráulico',
        '3' => 'Predial',
        '4' => 'Maquinário',
        '5' => 'Contenção de acidentes',
        '6' => 'Manutenção preditiva',
        '7' => 'Manutenção corretiva',
    ];

    public function getTypeProblemNameAttribute()
    {
        return self::TYPE_PROBLEM[$this->type_problem] ?? 'Desconhecido'; 
    }
}
