<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\called;
use App\Models\reservation;

class TeacherdashboardController extends Controller
{
    public function index()
    {
        $totalCalled = called::where('status', 1)->count();

        $totalCourt  = reservation::where('status', 1)->count();

        return view('Teacher-dashboard', ['total' => $totalCalled + $totalCourt]);
    }
}
