<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CourtresevertationsRequest;
use App\Models\reservation;
use Illuminate\Support\Facades\Auth;

class StudentcourtresevertationsController extends Controller
{
    public function index()
    {
        return view('Student-courtresevertations');
    }

    public function store(CourtresevertationsRequest $request)
    {
        $user = Auth::user();
        
        try {
            $courtReservation = reservation::create([
                'name_user'   => $request->name_user,
                'name_email'  => $request->name_email,
                'class'       => $request->class,
                'date'        => $request->date,
                'time'        => $request->time,
                'integrantes' => $request->integrantes,
            ]);
            
            // Se a criação for bem-sucedida, você pode retornar uma resposta de sucesso
            return redirect()->back()->with('success', 'Reserva enviada com sucesso! Fique atento ao seu email.');
        } catch (\Exception $e) {
            // Caso haja algum erro na criação
            return redirect()->back()->with('error' , 'Ocorreu um erro ao criar a reserva.');
        }

        
    }
}
