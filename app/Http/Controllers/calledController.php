<?php

namespace App\Http\Controllers;

use App\Models\called;
use Illuminate\Http\Request;


class calledController extends Controller
{
    public function index(){

        $calleds = called::all();

        $pendenteCont = 0;
         
        foreach($calleds as $called)
        {
            if($called->id == 1)
            {
                $pendenteCont ++;
            }                   
        }
     
        return view('teacher', ['calleds' => $calleds, 'count' => $pendenteCont]);
    }

    
}
