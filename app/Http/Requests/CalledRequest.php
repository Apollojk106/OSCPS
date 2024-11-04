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
            'problema' => 'required|integer',
            'andar' => 'required|string|exists:locations,roof',
            'local' => 'required|string|exists:locations,environment',
        ];
    }

    public function messages()
    {
        return [
            'problema.required' => 'O campo problema é obrigatório.',
            'problema.integer' => 'O campo problema deve ser um número inteiro.',
            'andar.required' => 'O campo andar é obrigatório.',
            'andar.string' => 'O campo andar deve ser uma string.',
            'local.required' => 'O campo local é obrigatório.',
            'local.string' => 'O campo local deve ser uma string.',
        ];
    }
}
