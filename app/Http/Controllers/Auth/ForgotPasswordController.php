<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\PasswordResetToken;
use Carbon\Carbon;

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

        $existingToken = PasswordResetToken::where('email', $request->email)
            ->first();

        if ($existingToken) {
            // Se o token foi criado há mais de 1 hora, exclui-o para substituir
            if ($existingToken->created_at < Carbon::now()->subHour()) {
                $existingToken->delete(); // Deleta o token antigo
            } else {
                // Se o token ainda é válido (criado nos últimos 60 minutos), retorna um erro
                return back()->withErrors(['email' => 'Já foi enviado um link de recuperação há menos de uma hora.']);
            }
        }

        $response = Password::sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {
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
