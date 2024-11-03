<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherdashboardController extends Controller
{
    public function index()
    {

        return view('Teacher-dashboard');
    }
}
