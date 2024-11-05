<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $table = 'administrators';  

    protected $fillable = [
        'name',       // Nome do administrador
        'RM',         // RM único do administrador
        'email',      // Email do administrador
        'password',   // Senha do administrador
        'specialty',  // Especialidade do administrador
    ];
  
    protected $casts = [
        'email_verified_at' => 'datetime', // Se houver um campo para verificar o email
    ];
}
