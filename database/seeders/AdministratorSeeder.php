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
        

        // Térreo
        Location::create([
            'Roof' => 'Térreo',           // Pátio
            'Environment' => 'Pátio',
        ]);

        Location::create([
            'Roof' => 'Térreo',           // Secretaria
            'Environment' => 'Secretaria',
        ]);

        Location::create([
            'Roof' => 'Térreo',           // Banheiros
            'Environment' => 'Banheiros',
        ]);

        Location::create([
            'Roof' => 'Térreo',           // Cantina
            'Environment' => 'Cantina',
        ]);

        // Andar 1
        Location::create([
            'Roof' => 'Andar 1',          // LAB 1
            'Environment' => 'LAB 1',
        ]);

        Location::create([
            'Roof' => 'Andar 1',          // LAB 2
            'Environment' => 'LAB 2',
        ]);

        Location::create([
            'Roof' => 'Andar 1',          // Sala dos Professores
            'Environment' => 'Sala dos Professores',
        ]);

        Location::create([
            'Roof' => 'Andar 1',          // Banheiro
            'Environment' => 'Banheiro',
        ]);

        // Andar 2
        Location::create([
            'Roof' => 'Andar 2',          // LAB 3
            'Environment' => 'LAB 3',
        ]);

        Location::create([
            'Roof' => 'Andar 2',          // LAB 4
            'Environment' => 'LAB 4',
        ]);

        Location::create([
            'Roof' => 'Andar 2',          // LAB 5
            'Environment' => 'LAB 5',
        ]);

        Location::create([
            'Roof' => 'Andar 2',          // LAB 6
            'Environment' => 'LAB 6',
        ]);

        // Andar 3
        Location::create([
            'Roof' => 'Andar 3',          // Sala Maker
            'Environment' => 'Sala Maker',
        ]);

        Location::create([
            'Roof' => 'Andar 3',          // Biblioteca
            'Environment' => 'Biblioteca',
        ]);

        Location::create([
            'Roof' => 'Andar 3',          // Banheiros
            'Environment' => 'Banheiros',
        ]);

        Location::create([
            'Roof' => 'Andar 3',          // LAB 7
            'Environment' => 'LAB 7',
        ]);

        Location::create([
            'Roof' => 'Andar 3',          // LAB 8
            'Environment' => 'LAB 8',
        ]);

        // Andar 4
        Location::create([
            'Roof' => 'Andar 4',          // Quadra Poliesportiva
            'Environment' => 'Quadra Poliesportiva',
        ]);

        Location::create([
            'Roof' => 'Andar 4',          // Banheiros
            'Environment' => 'Banheiros',
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
            'status' => '1',
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
            'RM' => '78965485462',
            'name' => 'João da Silva',
            'class' => '1A',
        ]);

        Student::create([
            'RM' => '12385435978',
            'name' => 'Maria Oliveira',
            'class' => '2B',
        ]);

        Student::create([
            'RM' => '76142853564',
            'name' => 'Carlos Souza',
            'class' => '3C',
        ]);

        Student::create([
            'RM' => '12345678912',
            'name' => 'Usuario Teste',
            'class' => 'Etim',
        ]);
    }
}
