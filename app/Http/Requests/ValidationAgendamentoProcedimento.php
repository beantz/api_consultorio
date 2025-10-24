<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidationAgendamentoProcedimento extends FormRequest
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
            'id_procedimento' => 'required|integer|exists:procedimento,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id_procedimento.exists' => 'O id fornecido não existe na tabela de procedimentos',
            'id_procedimento.integer' => 'O id precisa ser um número inteiro'
        ];
    }

}
