<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\location;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\cookieController;


class studentController extends Controller
{
    public function index(Request $request)
    {
        $dados = location::all()->unique('roof');

        $andares = $this->retornarAndares($dados);

        $nome = $_POST('rm') ?? ''; 

        return view('student', ['dados' => $dados, 'userName' => $nome]);
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
