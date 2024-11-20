<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('Auth-passwords-email');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        if (!User::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => 'Esse e-mail não está cadastrado.']);
        }        

        $response = Password::sendResetLink($request->only('email'));


        if ($response == Password::RESET_LINK_SENT) {
            // Aqui você pode armazenar o token manualmente, se necessário
            // Isso é opcional, pois o Laravel já faz isso
            $token = Str::random(60); // Gere um token aleatório
            PasswordReset::create([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]);

            return back()->with('status', 'Link de recuperação enviado!');
        } else {

            dd($response);
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
