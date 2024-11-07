<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrator extends Authenticatable
{
    use HasFactory;

    protected $guard = 'admin';

    protected $table = 'administrators';  

    public $timestamps = false;

    protected $fillable = [
        'name',       // Nome do administrador
        'RM',         // RM único do administrador
        'email',      // Email do administrador
        'password',   // Senha do administrador
        'specialty',  // Especialidade do administrador
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
  
    protected $casts = [
        'email_verified_at' => 'datetime', 
    ];
}
