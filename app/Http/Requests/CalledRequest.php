<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalledRequest extends FormRequest
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
            'type_problem' => 'required|integer',
            'roof' => 'required|string|exists:locations,roof',
            'environment' => 'required|string|exists:locations,environment',
        ];
    }

    public function messages()
    {
        return [
            'type_problem.required' => 'O campo problema é obrigatório.',
            'type_problem.integer' => 'O campo problema deve ser um número inteiro.',
            'roof.required' => 'O campo andar é obrigatório.',
            'roof.string' => 'O campo andar deve ser uma string.',
            'environment.required' => 'O campo local é obrigatório.',
            'environment.string' => 'O campo local deve ser uma string.',
        ];
    }
}
