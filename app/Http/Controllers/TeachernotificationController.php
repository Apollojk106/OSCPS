<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\called;
use App\Models\reservation;
use Illuminate\Support\Facades\Auth;
use App\Mail\ReservationStatusChanged;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class TeachernotificationController extends Controller
{
    public function index()
    {
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

        $calledsStatus1 = $calleds->where('status', 'Pendente'); // Status 1
        $calledsStatus2 = $calleds->where('status', 'Em Andamento'); //Status 2

        if ($calledsStatus1->isEmpty() && $calledsStatus2->isEmpty()) {
            $messages[] = 'Nenhum chamado encontrado!';
        }
        else{
            if ($calledsStatus1->isEmpty()) {
                $messages[] = 'Nenhum chamado pendente encontrado!';
            }
            if($calledsStatus2->isEmpty()){
                $messages[] = 'Nenhum chamado Em Andamento encontrado!';
            }
        }


        if ($reservations->isEmpty()) {
            $messages[] = 'Nenhuma reserva encontrada!';
        }

        return view('Teacher-notification', compact('calledsStatus1', 'calledsStatus2', 'reservations', 'messages'));
    }

    public function accept(Reservation $reservation)
    {
        $reservation->status = 'accepted'; // Supondo que o status "accepted" indique que a reserva foi aceita
        $reservation->save();

        Mail::to($reservation->name_email)->send(new ReservationStatusChanged($reservation, null, null, 'aceita'));

        Log::info('Reserva aceita com sucesso.', [
            'reservation_id' => $reservation->id,
            'new_status' => "aceito",
        ]);

        return redirect()->back()->with('success', 'Reserva aceita com sucesso!');
    }

    public function reject(Reservation $reservation)
    {
        $reservation->status = 'rejected'; // Supondo que o status "rejected" indica que a reserva foi recusada
        $reservation->save();

        Mail::to($reservation->name_email)->send(new ReservationStatusChanged($reservation, null, null, 'recusada'));

        Log::info('Reserva recusada com sucesso.', [
            'reservation_id' => $reservation->id,
            'new_status' => "rejeitado",
        ]);

        return redirect()->back()->with('success', 'Reserva recusada!');
    }

    public function updateStatus(Called $called, Request $request)
    {
        $status = $request->input('status'); // Recebe o valor do status enviado pelo formulário

        Log::info('Atualizando status do chamado.', [
            'called_id' => $called->id,
            'user_rm' => Auth::user()->RM,
            'current_status' => $called->status,
            'new_status' => $status,
        ]);

        if ($status == 'Em andamento') {
            $called->status = '2'; // Atualiza para "Em Andamento"
        } elseif ($status == 'Concluído') {
            $called->status = '3'; // Atualiza para "Concluído"
        }

        Mail::to($called->email)->send(new ReservationStatusChanged(null, $called, $status, 'atualizado'));

        $called->save();

        Log::info('Status do chamado atualizado com sucesso.', [
            'called_id' => $called->id,
            'new_status' => $called->status,
        ]);

        return redirect()->back()->with('success', 'Status do chamado atualizado com sucesso!');
    }
}
