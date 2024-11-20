<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ];
    }

    /**
     * Obtenha as mensagens de erro personalizadas para as regras de validação.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'O campo de e-mail é obrigatório.',
            'email.email' => 'O e-mail informado não é válido.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
            'token.required' => 'O token é obrigatório.'
        ];
    }
}
