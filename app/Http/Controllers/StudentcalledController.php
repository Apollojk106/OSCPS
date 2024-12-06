<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalledRequest;
use Illuminate\Http\Request;
use App\Models\location;
use App\Models\called;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StudentcalledController extends Controller
{
    public function index()
    {
        $andares = Location::distinct()->get(['roof']);

        // Obter os locais agrupados por andar (associar locais ao andar)
        $locais = Location::all()->groupBy('roof');

        $problem = null;

        return view('Student-called', ['andares' => $andares, 'locais' => $locais, 'problem' => $problem]);
    }

    public function getlocais($roof, $problem)
    {
        $problemas = [
            '1' => 'Elétricos',
            '2' => 'Hidráulicos',
            '3' => 'Prediais',
            '4' => 'Maquinário',
            '5' => 'Contenção de acidentes',
            '6' => 'Manutenção preditiva',
            '7' => 'Manutenção corretiva',
        ];

        $value = $problem;
        $problem = $problemas[$problem] ?? 'Problema desconhecido';
        $selectandar = $roof;

        $andares = Location::distinct()->get(['roof']);

        $locais = Location::where('roof', $roof)->get();

        return view('Student-called', ['andares' => $andares, 'locais' => $locais,'value' => $value, 'problem' => $problem, 'selectandar' => $selectandar]);
    }

    public function retornalocais()
    {
        // Obtem todas as localizações
        $locations = Location::all();

        $groupedLocations = $locations->groupBy('roof')->map(function ($group) {
            return $group->pluck('environment')->toArray();
        });

        return $groupedLocations;
    }

    public function store(CalledRequest $request)
    {
        $user = Auth::user();

        // Procurando um chamado existente com o mesmo local, ambiente e tipo de problema
        $called = Called::where('roof', $request->roof)
            ->where('environment', $request->environment)
            ->where('type_problem', $request->type_problem)
            ->first();

        // Se o chamado já existir
        if ($called && $called->status != '3') {
            // Aumenta o valor de recalled
            $called->recalled += 1;

            // Se recalled atingir 5, muda o priority para 2
            if ($called->recalled >= 5 && $called->priority == '1') {
                $called->priority = '2';
            }

            // Se recalled atingir 10, muda o priority para 3
            if ($called->recalled >= 10 && $called->priority == '2') {
                $called->priority = '3';
            }

            // Salva a atualização
            $called->save();

            Log::info('Rechamado com os parâmetros fornecidos.', [
                'roof' => $request->roof,
                'environment' => $request->environment,
                'type_problem' => $request->type_problem,
                'obs' => $request->obs,
            ]);

            return redirect()->route('student.called')->with('success', 'Called created successfully!');
        }

        $called = Called::create([
            'status' => '1', // Exemplo de valor para status
            'priority' => '1', // Inicia com prioridade 1
            'recalled' => 1, // Inicia com 1 recall
            'type_problem' => $request->type_problem,
            'RM' => $user->RM, // Nome do usuário autenticado
            'email' => $user->email, // E-mail do usuário autenticado
            'roof' => $request->roof, // Local
            'environment' => $request->environment, // Ambiente
            'obs' => $request->obs,
        ]);

        Log::info('Criando chamado com os parâmetros fornecidos.', [
            'roof' => $request->roof,
            'environment' => $request->environment,
            'type_problem' => $request->type_problem,
            'obs' => $request->obs,
        ]);

        return redirect()->route('student.called')->with('success', 'Chamado criado com sucesso!');
    }
}
