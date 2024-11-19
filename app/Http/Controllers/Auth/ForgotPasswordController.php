<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('Auth-passwords-email');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $response = Password::sendResetLink(
            $request->only('email')
        );

        dd($response);

        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('status', 'Link de recuperação enviado!');
        } else {
            return back()->withErrors(['email' => 'Não conseguimos encontrar esse e-mail.']);
        }
    }

    public function showResetFormToken($token)
    {
        return view('Auth-passwords-reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Senha redefinida com sucesso!');
        } else {
            return back()->withErrors(['email' => 'Erro ao redefinir senha.']);
        }
    }

    
}
