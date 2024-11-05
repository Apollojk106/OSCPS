<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrator;

class StudentcontactsController extends Controller
{
    public function index()
    {
        $administrators = Administrator::select('name', 'email')->get();

        return view('Student-contacts', ['administrators' => $administrators]);
    }
}
