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
        'RM',
        'email',
        'roof',
        'obs',
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

    const STATUS = [
        '1' => 'Pendente',
        '2' => 'Em Andamento',
        '3' => 'Concluído',
    ];

    public function getTypeProblemNameAttribute()
    {
        return self::TYPE_PROBLEM[$this->type_problem] ?? 'Desconhecido'; 
    }

    public function getStatusNameAttribute()
    {
        return self::STATUS[$this->status] ?? 'Desconhecido'; 
    }
}
