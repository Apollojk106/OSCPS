<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function Getlogin() {
        return view('login');
    }

    public function Getregister() {
        return view('register');
    }

    public function Studentlogin(Request $request)
    {
        return redirect('/Student/dashboard');

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

    public function Teacherlogin(Request $request)
    {
        return redirect('/Teacher/dashboard');
    }

    public function StudentRegister(Request $request)
    {
        return redirect('/Student/dashboard');
    }

    public function logout()
    {
        //Auth::logout(); // Deslogar o usuário
        return view('/login');
    }
}
