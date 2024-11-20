<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\PasswordResetToken;

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
            return back()->withErrors(['email' => 'Esse e-mail é inválido!']);
        }        

        $response = Password::sendResetLink($request->only('email'));


        if ($response == Password::RESET_LINK_SENT) {
            // Aqui você pode armazenar o token manualmente, se necessário
            // Isso é opcional, pois o Laravel já faz isso
            $token = Str::random(60); // Gere um token aleatório

            PasswordResetToken::create([
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]);

            return back()->with('success', 'Link de recuperação enviado!');
        } else {
            return back()->withErrors(['email' => 'Não conseguimos encontrar esse e-mail.']);
        }
    }

    public function showResetFormToken($token)
    {
        return view('Auth-passwords-reset', ['token' => $token]);
    }

    public function reset(ResetRequest $request)
    {
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Senha redefinida com sucesso!');
        } else {
            return back()->withErrors(['email' => 'Erro ao redefinir senha.']);
        }
    }

    
}
