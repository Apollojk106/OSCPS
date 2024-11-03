<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentdashboardController extends Controller
{
    public function index()
    {

        return view('Student-dashboard');
    }
}
