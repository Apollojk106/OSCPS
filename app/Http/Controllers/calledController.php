<?php

namespace App\Http\Controllers;

use App\Models\called;
use Illuminate\Http\Request;


class calledController extends Controller
{
    public function index(){

        $calleds = called::all();

        return view('teacher', ['calleds' => $calleds]);
    }
}
