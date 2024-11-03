<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentcontactsController extends Controller
{
    public function index()
    {

        return view('Student-contacts');
    }
}
