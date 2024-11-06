<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\secretary;

class StudentcontactsController extends Controller
{
    public function index()
    {
        $secretaries = secretary::all(); 

        return view('Student-contacts', ['secretaries' => $secretaries]);
    }
}
