<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CourtresevertationsRequest;
use App\Models\reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
            $courtReservation = Reservation::create([
                'name_user'   => $user->name,
                'name_email'  => $user->email,
                'class'       => $request->class,
                'date'        => Carbon::parse($request->date . ' ' . $request->time),   
                'integrantes' => $request->integrantes,  
            ]);
                      
            return redirect()->back()->with('success', 'Reserva enviada com sucesso! Fique atento ao seu email.');
        } catch (\Exception $e) {

            return redirect()->back()->with('errors' , 'Ocorreu um erro ao criar a reserva.');
        }

        
    }
}
