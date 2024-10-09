<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cookieController extends Controller
{
    public static function setCookie($nome, $valor){
        $response = response($valor);
        $response->withCookie($nome);
        return $response;
    }

    public static function getCookie($nome){
        return request()->cookie($nome);
    }

    public static function delCookie($nome){
        return response('deleted')->cookie($nome, null, -1);
    }

}
