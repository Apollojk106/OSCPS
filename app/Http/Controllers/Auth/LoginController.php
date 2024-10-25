<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tentativa de autenticação
        if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            // Autenticação bem-sucedida
            return response()->json(['message' => 'Login bem-sucedido!', 'redirectUrl' => '/dashboard']);
        }

        // Falha na autenticação
        return response()->json(['message' => 'Credenciais inválidas.'], 401);
    }

    public  function logout()
    {
        //Auth::logout(); // Deslogar o usuário
        return view('/login');
    }
}
