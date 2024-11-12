<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\called;
use App\Models\location;
use App\Models\reservation;
use App\Models\secretary;
use App\Models\Student;
use App\Models\User;

class AdministratorSeeder extends Seeder
{
    public function run()
    {
        // Cria um administrador com dados fictícios
        User::create([
            'name' => 'Administrador',
            'RM' => '123456789',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456789'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Aluno Teste',
            'RM' => '987654321',
            'email' => 'aluno@example.com',
            'password' => bcrypt('123456789'),
            'role' => 'user',
        ]);

        // Criar 5 chamados de exemplo
        Called::create([
            'status' => '1',
            'priority' => '2',
            'recalled' => 0,
            'type_problem' => '3',
            'RM' => 'João da Silva',
            'email' => 'joao@example.com',
            'roof' => 'Telhado de vidro',
            'environment' => 'Ambiente com poucas janelas',
        ]);

        Called::create([
            'status' => '2',
            'priority' => '1',
            'recalled' => 2,
            'type_problem' => '1',
            'RM' => 'Maria Oliveira',
            'email' => 'maria@example.com',
            'roof' => 'Telhado de concreto',
            'environment' => 'Ambiente ventilado',
        ]);

        Called::create([
            'status' => '1',
            'priority' => '2',
            'recalled' => 1,
            'type_problem' => '3',
            'RM' => 'Carlos Oliveira',
            'email' => 'carlos.oliveira@example.com',
            'roof' => 'Telhado de vidro',
            'environment' => 'Sala de reuniões',
        ]);
        
        Called::create([
            'status' => '2',
            'priority' => '3',
            'recalled' => 0,
            'type_problem' => '5',
            'RM' => 'José Santos',
            'email' => 'jose.santos@example.com',
            'roof' => 'Telhado de madeira',
            'environment' => 'Estacionamento',
        ]);

        Called::create([
            'status' => '3',
            'priority' => '1',
            'recalled' => 0,
            'type_problem' => '4',
            'RM' => 'Fernanda Costa',
            'email' => 'fernanda.costa@example.com',
            'roof' => 'Telhado de alumínio',
            'environment' => 'Corredor principal',
        ]);
        

        // Inserir 10 registros de exemplo
        Location::create([
            'roof' => 'Telhado de metal',
            'environment' => 'Ambiente fechado com luz natural',
        ]);

        Location::create([
            'roof' => 'Telhado de telha',
            'environment' => 'Ambiente com ventilação artificial',
        ]);

        // Criar 3 reservas de exemplo
        Reservation::create([
            'RM' => '12345678923',
            'name_email' => 'carlos@example.com',
            'status' => '1',
            'class' => 'Turma A',
            'date' => now(),
            'integrantes' => 'Carlos Souza, João Silva, Maria Oliveira',
        ]);

        Reservation::create([
            'RM' => '12345678968',
            'name_email' => 'ana@example.com',
            'status' => '2',
            'class' => 'Turma B',
            'date' => now()->addDays(1),
            'integrantes' => 'Ana Costa, Júlio Silva, Beatriz Ribeiro',
        ]);

        Secretary::create([
            'name' => 'Fernanda Lima',
            'email' => 'fernanda@example.com',
            'entry_time' => '08:00:00',
            'exit_time' => '17:00:00',
        ]);

        Secretary::create([
            'name' => 'Lucas Pereira',
            'email' => 'lucas@example.com',
            'entry_time' => '09:00:00',
            'exit_time' => '18:00:00',
        ]);

        Student::create([
            'RM' => '12345',
            'name' => 'João da Silva',
            'class' => '1A',
        ]);

        Student::create([
            'RM' => '12346',
            'name' => 'Maria Oliveira',
            'class' => '2B',
        ]);

        Student::create([
            'RM' => '12347',
            'name' => 'Carlos Souza',
            'class' => '3C',
        ]);
    }
}
