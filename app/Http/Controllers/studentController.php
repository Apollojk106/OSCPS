<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\location;
use Illuminate\Support\Facades\Cookie;


class studentController extends Controller
{
    public function index(Request $request)
    {
        $dados = location::all()->unique('roof');

        $andares = $this->retornarAndares($dados);

        /*$string = "";
        foreach($andares as $andare)
        {
            $string = $string . $andare;
        } 
        echo $string;*/
        $minutes = 60; // Tempo de expiração do cookie (em minutos)
        $cookie = cookie('user_name', $request->name, $minutes);

        return view('student', ['dados' => $dados]);
    }

    public function retornarAndares($dados)
    {
        $andares = array();

        foreach($dados as $dado)
        {           
            if(in_array($dado->roof, $andares))
            {
                array_push($andares, $dado->roof);
            }
        }
        
        return $andares;
    }
}
