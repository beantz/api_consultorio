<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidationOrcamentosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
public function rules(): array
    {
        return [
            'valor_total' => 'required|numeric',
            'relatorio' => 'required|max:240|min:3',
        ];
    }

    public function messages() {

        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'relatorio.min' => 'O campo relatorio deve ter no mínimo 3 caracteres',
            'relatorio.max' => 'O campo relatorio deve ter no máximo 240 caracteres',
            'valor_total.numeric' => 'O campo total deve ter no formato numérico',
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
