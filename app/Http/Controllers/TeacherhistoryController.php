<?php

namespace App\Http\Controllers;

use App\Models\called;
use App\Models\reservation;
use Illuminate\Http\Request;

class TeacherhistoryController extends Controller
{
    public function index()
    {
        $calleds = Called::orderByRaw("FIELD(status, '1', '2', '3')")->get();

        $calleds->filter(fn($called) => $called->status == 1)->count();
        
        $reservations = Reservation::where('status', '1')->get();

        return $this->RetornarDashboard($calleds, $reservations);
    }

    public function filter(Request $request)
    {   
        $statusFilter = $request->input('status'); 

        $calledsQuery = Called::query(); 

        if ($statusFilter && in_array($statusFilter, [1, 2, 3])) {
            $calledsQuery->where('status', $statusFilter);
        }else{
            $calledsQuery->orderBy('status');
        }
    
        $calleds = $calledsQuery->get();
    
        if ($statusFilter && in_array($statusFilter, [1, 2, 3])) {
            $reservations = Reservation::where('status', $statusFilter)->get();
        } else {
            $reservations = Reservation::orderBy('status')->get();
        }   

        $calleds = $calledsQuery->get();

        $reservations = Reservation::where('status', $statusFilter)->get();

        return $this->RetornarDashboard($calleds, $reservations);
    }

    public function RetornarDashboard($calleds, $reservations) 
    {
        
        $statusMap = [
            1 => 'Pendente',
            2 => 'Em Andamento',
            3 => 'Concluido',
        ];

        $priorityMap = [
            1 => 'Baixa',
            2 => 'Media',
            3 => 'Alta',
        ];

        $problemMap = [
            1 => 'Elétricos',
            2 => 'Hidráulicos',
            3 => 'Prediais',
            4 => 'Maquinário (computadores)',
            5 => 'Contenção de acidentes (piso molhado)',
            6 => 'Manutenção preditiva',
            7 => 'Manutenção corretiva',
        ];

        $calleds->transform(function ($called) use ($statusMap, $priorityMap, $problemMap) {
            $called->status = $statusMap[$called->status] ?? 'Desconhecido'; // Fallback
            $called->priority = $priorityMap[$called->priority] ?? 'Desconhecida'; // Fallback
            $called->type_problem = $problemMap[$called->type_problem] ?? 'Desconhecido'; // Fallback
            return $called;
        });

        return view('Teacher-history', ['calleds' => $calleds, 'reservations' => $reservations]);
    }

}
