<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\PasswordResetToken;
use App\Mail\CustomPasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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

        $existingToken = PasswordResetToken::where('email', $request->email)->first();

        if ($existingToken) {
            // Se o token foi criado há mais de 1 hora, exclui-o para substituir
            if ($existingToken->created_at < Carbon::now()->subHour()) {
                PasswordResetToken::where('email', $request->email)->delete();
            } else {
                return back()->withErrors(['email' => 'Já foi enviado um link de recuperação há menos de uma hora.']);
            }
        }

        $user = User::where('email', $request->email)->first();
        $token = Str::random(60);

        try {
            Mail::to($request->email)->send(new CustomPasswordReset($token, $request->email));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->withErrors(['email' => 'Ocorreu um erro ao enviar o e-mail. Tente novamente mais tarde.']);
        }

        PasswordResetToken::create([
            'email' => $user->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        // Retorna sucesso
        return back()->with('success', 'Link de recuperação enviado!');

        /*  
        $response = Password::sendResetLink($request->only('email'));

        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('success', 'Link de recuperação enviado!');
        } else {
            return back()->withErrors(['email' => 'Não conseguimos encontrar esse e-mail.']);
        }*/
    }

    public function showResetFormToken($token)
    {
        return view('Auth-passwords-reset', ['token' => $token]);
    }

    public function reset(ResetRequest $request)
    {
        // Valida o request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email não encontrado.']);
        }

        $passwordResetToken = PasswordResetToken::where('email', $request->email)->first();

        if (!$passwordResetToken) {
            return back()->withErrors(['email' => 'Token inválido ou expirado.']);
        }

        // Atualiza a senha do usuário
        $user->password = Hash::make($request->password);
        $user->save();

        PasswordResetToken::destroy($passwordResetToken->id);

        return redirect()->route('login')->with('success', 'Senha redefinida com sucesso!');
    }
}
