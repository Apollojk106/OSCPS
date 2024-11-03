<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeachernotificationController extends Controller
{
    public function index()
    {

        return view('Teacher-notification');
    }
}
