<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\location;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\cookieController;


class studentController extends Controller
{
    public function index()
    {
        $dados = location::all()->unique('roof');

        $andares = $this->retornarAndares($dados);

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

    public function retornarTelaAndares($andar){
        $dados = location::all()->unique('roof');

        $locais = location::where('roof', $andar)->pluck('environment');

        return view('student', ['dados' => $dados, 'locais' => $locais]);
    }

    public function show($id)
    {
        // Aqui você pode utilizar o valor de $id para realizar alguma ação,
        // como buscar um estudante no banco de dados
        echo $id;
    }
}


