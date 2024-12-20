<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\called;
use App\Models\reservation;
use Illuminate\Support\Facades\Auth;

class TeacherdashboardController extends Controller
{
    public function index()
    {
        $pendetCalled  = called::where('status', 1)->count();
        $AndamentoCalled  = called::where('status', 2)->count();
        $ConcluidoCalled  = called::where('status', 3)->count();
       
        $totalCalled = $pendetCalled + $AndamentoCalled + $ConcluidoCalled;   

        $pendentReservate = reservation::where('status', 1)->count();
        $AndamentoReserve = reservation::where('status', "accepted")->count();
        $ConcluidoReserve = reservation::where('status', "rejected")->count();

        $totalReservate = $pendentReservate + $AndamentoReserve + $ConcluidoReserve;


        return view('Teacher-dashboard', [     
            'ConcluidoCalled' => $ConcluidoCalled,   
            'AndamentoCalled' => $AndamentoCalled,
            'pendetCalled' => $pendetCalled,
            'totalCalled' => $totalCalled,
            'pendetReserve' => $pendentReservate,
            'AndamentoReserve' => $AndamentoReserve,
            'ConcluidoReserve' => $ConcluidoReserve,
            'totalReservate' => $totalReservate,
        ]);
    }

}
