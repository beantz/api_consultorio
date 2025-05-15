<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidationProcedimentos extends FormRequest
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
            'nome' => 'required|min:3|max:70',
            'orientacoes' => 'required|max:140',
            'medicamento_pre' => 'max:100',
            'medicamente_pos' => 'max:100',
        ];
    }

    public function messages() {

        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 70 caracteres',
            'orientacoes.max' => 'O campo nome deve ter no máximo 140 caracteres',
            'medicamento_pre.max' => 'O campo nome deve ter no máximo 100 caracteres',
            'medicamente_pos.max' => 'O campo nome deve ter no máximo 100 caracteres',
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
