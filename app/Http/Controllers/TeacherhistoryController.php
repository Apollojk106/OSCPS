<?php

namespace App\Http\Controllers;

use App\Models\called;
use App\Models\reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherhistoryController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $calleds = Called::whereIn('status', ['1', '2', '3'])
            ->orderByRaw("FIELD(status, '1', '2', '3')")
            ->get();

        $calleds->filter(fn($called) => $called->status == 1)->count();

        $reservations = Reservation::whereIn('status', ['1', '2', '3'])
            ->orderByRaw("FIELD(status, '1', '2', '3')")
            ->get();

        return $this->RetornarDashboard($calleds, $reservations);
    }

    public function filter(Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $statusFilter = $request->input('status');

        $calledsQuery = Called::query();

        if ($statusFilter && in_array($statusFilter, [1, 2, 3])) {
            $calledsQuery->where('status', $statusFilter);
        } else {
            $calledsQuery->orderBy('status');
        }

        $calleds = $calledsQuery->orderBy('recalled', 'desc')->get();

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
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

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
