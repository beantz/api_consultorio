<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidationAgendamento extends FormRequest
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
            'data_consulta' => 'required|date',
            'relatorio_consulta' => 'nullable|string|max:240',
            'user_patients_id' => 'required|integer|exists:users,id'
        ];
    }

    public function messages() {

        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'relatorio_consulta.max' => 'O campo nome deve ter no máximo 240 caracteres',
            'relatorio_consulta.string' => 'O campo de relatorio deve ser do tipo string',
            'data_consulta.date' => 'A data de consulta inválida',
            'user_patients_id.exists' => 'O id de usuario não existe',
            'user_patients_id.integer' => 'O id de usuario precisa ser um numero inteiro'
        ];

    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Erros de validação',
                'erros' => $validator->errors(),
            ], 420)
        );
    }
}
