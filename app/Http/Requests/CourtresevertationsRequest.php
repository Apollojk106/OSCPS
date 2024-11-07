<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourtresevertationsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'class' => 'required|string|max:255',
            'date' => 'required|date|after:now',
            'time' => 'required|date_format:H:i',
            'integrantes' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'class.required' => 'O campo Turma é obrigatório.',
            'date.required' => 'O campo Data é obrigatório.',
            'time.required' => 'O campo Horário é obrigatório.',
            'integrantes.required' => 'O campo Integrantes é obrigatório.',
        ];
    }
}
