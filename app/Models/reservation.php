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

    const STATUS = [
        '1' => 'Pendente',
        '2' => 'Aceitado',
        '3' => 'Negado',
    ];
   
    public function getStatusNameAttribute()
    {
        return self::STATUS[$this->status] ?? 'Desconhecido'; 
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
