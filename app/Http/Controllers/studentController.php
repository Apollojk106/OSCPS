<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\location;


class studentController extends Controller
{
    public function index()
    {
        $dados = location::all()->unique('roof');

        $andares = $this->retornarAndares($dados);

        /*$string = "";
        foreach($andares as $andare)
        {
            $string = $string . $andare;
        } 
        echo $string;*/

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
