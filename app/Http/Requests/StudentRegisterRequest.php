<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'RM' => 'required|string|size:11|unique:users,RM|exists:students,RM',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'RM.required' => 'O campo RM é obrigatório.',
            'RM.size' => 'O RM deve ter 11 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'RM.unique' => 'Este RM já está cadastrado.',
            'email.unique' => 'Este email já está cadastrado.',
            'password.confirmed' => 'As senhas não coincidem.',
            'RM.unique' => 'Este RM já está cadastrado.',  
            'RM.exists' => 'O RM é invalido.',

        ];
    }
}
