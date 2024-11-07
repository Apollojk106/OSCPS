<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\called;

class TeachernotificationController extends Controller
{
    public function index()
    {
        $calleds = Called::where('status', '1')->get(); // Pegando os chamados com status 1
        return view('Teacher-notification', compact('calleds'));
    }
}
