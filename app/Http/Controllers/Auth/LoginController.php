<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StudentRegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Student;

class LoginController extends Controller
{
    public function Getlogin() {
        return view('login');
    }

    public function Getregister() {
        return view('register');
    }

    public function Studentlogin(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {     
            
            $user = Auth::user();
            dd($$user);

            if($user->role == 'admin')
            {
               
                return redirect('/Teacher/dashboard');
            }

            return redirect()->intended('/Student/dashboard');
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    public function StudentRegister(StudentRegisterRequest $request)
    {   
        if (Student::where('RM', $request->RM)->exists()) {
            return back();
        }

        $user = User::create([
            'name' => $request->name,
            'RM' => $request->RM,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);
        
        Auth::login($user);

        return redirect('/Student/dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

    public function Teacherlogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        /*if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/Teacher/dashboard');
        }*/
        
        return back()->withErrors(['email' => 'Credenciais inválidas']);
    }
}
