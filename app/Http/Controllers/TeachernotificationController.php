<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\called;
use App\Models\reservation;
use Illuminate\Support\Facades\Auth;
use App\Mail\ReservationStatusChanged;
use Illuminate\Support\Facades\Mail;


class TeachernotificationController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $messages = [];

        $calleds = Called::whereIn('status', ['1', '2'])
            ->orderByRaw("FIELD(status, '1', '2')")
            ->get();
        $reservations = reservation::where('status', '1')->get();

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

        if ($calleds->isEmpty()) {
            $messages[] = 'Nenhum chamado encontrada!';
        }

        if ($reservations->isEmpty()) {
            $messages[] = 'Nenhuma reserva encontrada!';
        }

        return view('Teacher-notification', compact('calleds', 'reservations', 'messages'));
    }

    public function accept(Reservation $reservation)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $reservation->status = '2'; // Supondo que o status "accepted" indique que a reserva foi aceita
        $reservation->save();

        //Mail::to($reservation->name_email)->send(new ReservationStatusChanged($reservation, null, null, 'aceita'));

        return redirect()->back()->with('success', 'Reserva aceita com sucesso!');
    }

    public function reject(Reservation $reservation)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $reservation->status = '3'; // Supondo que o status "rejected" indica que a reserva foi recusada
        $reservation->save();

        //Mail::to($reservation->name_email)->send(new ReservationStatusChanged($reservation, null, null, 'recusada'));

        return redirect()->back()->with('success', 'Reserva recusada!');
    }

    public function updateStatus(Called $called, Request $request)
    {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return redirect()->route('student.dashboard');
        }

        $status = $request->input('status'); // Recebe o valor do status enviado pelo formulário

        if ($status == 'Em andamento') {
            $called->status = '2'; // Atualiza para "Em Andamento"
        } elseif ($status == 'Concluído') {
            $called->status = '3'; // Atualiza para "Concluído"
        }

        //Mail::to($called->email)->send(new ReservationStatusChanged(null, $called, $status, 'atualizado'));

        $called->save();

        return redirect()->back()->with('success', 'Status do chamado atualizado com sucesso!');
    }
}
