<?php

namespace App\Http\Controllers;

use App\Models\called;
use Illuminate\Http\Request;

class studentController extends Controller
{
    public function index()
    {


        return view('student');
    }
}
