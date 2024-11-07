<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Administrator;

class AdministratorSeeder extends Seeder
{
    public function run()
    {
        // Cria um administrador com dados fictícios
        Administrator::create([
            'name' => 'Administrador Exemplo',
            'RM' => '12345678910',
            'email' => 'adm@adm',
            'password' => Hash::make('123'), 
            'specialty' => 'Gestor',
        ]);
    }
}
