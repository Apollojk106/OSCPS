<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StudentRegisterRequest;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class LoginController extends Controller
{
    public function Getlogin() {
        return view('login');
    }

    public function Getregister() {
        return view('register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('login', 'password');

        if (preg_match('/^\d{11}$/', $credentials['login'])) {
            return $this->RMlogin($credentials['login'], $credentials['password']);
        } else {
            return $this->Emaillogin($credentials['login'], $credentials['password']);
        }

    }

    public function RMlogin($RM , $password)
    {

        if (Auth::attempt(['RM' => $RM, 'password' => $password])) {     
            
            $user = Auth::user();

            Log::info('Login realizado com sucesso via RM.', [
                'RM' => $RM,
                'role' => $user->role,
            ]);

            if(strtolower($user->role) !== 'admin')
            {
                return redirect('/Student/dashboard');
            }
            else
            {
                return redirect('/Adm/dashboard');
            }

        }

        return back()->withErrors([
            'RM' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    public function Emaillogin($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {     
            
            $user = Auth::user();

            Log::info('Login realizado com sucesso via email.', [
                'email' => $email,
                'role' => $user->role,
            ]);

            if(strtolower($user->role) !== 'admin')
            {
                return redirect('/Student/dashboard');
            }
            else
            {
                return redirect('/Adm/dashboard');
            }

        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    public function StudentRegister(StudentRegisterRequest $request)
    {   
 
        $user = User::create([
            'name' => $request->name,
            'RM' => $request->RM,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);
        
        Auth::login($user);

        return redirect('/Student/dashboard')->with('success', 'Cadastro realizada com sucesso!');
    }

    public function logout()
    {
        if (Auth::check())  
        {
            Auth::logout();
        }

        return redirect('/login');
    }

}
