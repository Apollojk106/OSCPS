<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CourtresevertationsRequest;
use App\Models\reservation;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StudentcourtresevertationsController extends Controller
{
    public function index()
    {
        $classes = Student::distinct()->get(['class']);;

        return view('Student-courtresevertations', ["classes" => $classes]);
    }

    public function store(CourtresevertationsRequest $request)
    {
        $user = Auth::user();

        try {
            $courtReservation = Reservation::create([
                'RM'   => $user->RM,
                'name_email'  => $user->email,
                'status' => '1',
                'class'       => $request->class,
                'date'        => Carbon::parse($request->date . ' ' . $request->time),   
                'integrantes' => $request->integrantes,  
            ]);
                      
            return redirect()->back()->with('success', 'Reserva criada com sucesso!');
        } catch (\Exception $e) {

            return redirect()->back()->with('errors' , 'Ocorreu um erro ao criar a reserva.');
        }

        
    }
}
