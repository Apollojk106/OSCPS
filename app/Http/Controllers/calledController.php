<?php

namespace App\Http\Controllers;

use App\Models\called;
use Illuminate\Http\Request;


class calledController extends Controller
{
    public function index()
    {

        $calleds = called::all();

        $pendenteCont = 0;

        foreach ($calleds as $called) {
            if ($called->status == 1) {
                $pendenteCont = $pendenteCont + 1;
            }

            $called->status = $this->WriteStatus($called->status);
            $called->priority = $this->WritePriority($called->priority);
            $called->type_problem = $this->WriteProblem($called->type_problem);
        }

        return view('teacher', ['calleds' => $calleds, 'count' => $pendenteCont]);
    }

    public function WriteStatus($Value)
    {
        switch ($Value) {
            case '1':
                return 'Pendente';
                break;
            case '2':
                return 'Em Andamento';
                break;
            case '3':
                return 'Concluido';
                break;
        }
    }

    public function WritePriority($Value)
    {
        switch ($Value) {
            case '1':
                return 'Baixa';
                break;
            case '2':
                return 'Media';
                break;
            case '3':
                return 'Alta';
                break;
        }
    }

    public function WriteProblem($Value)
    {
        switch ($Value) {
            case '1':
                return 'Elétricos';
                break;
            case '2':
                return 'Hidráulicos';
                break;
            case '3':
                return 'Prediais';
                break;
            case '4':
                return 'Maquinário (computadores)';
                break;
            case '5':
                return 'Contenção de acidentes (piso molhado)';
                break;
            case '6':
                return 'Manutenção preditiva';
                break;
            case '7':
                return 'Manutenção corretiva';
                break;
        }


    }

    /**Elétricos 
Hidráulicos 
Prediais 
Maquinário ( computadores) 
Contenção de acidentes ( piso molhado ) 
Manutenção preditiva 
Manutenção corretiva */
}
