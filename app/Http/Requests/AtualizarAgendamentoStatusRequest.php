<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AtualizarAgendamentoStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules()
    {
        return [
            'status' => [
                'required',
                /*regra de validação, ver se o valor recebido da dentro dos valores permitidos*/
                Rule::in(['finalizado' , 'cancelado' , 'ativo'])
            ],
            'relatorio_consulta' => 'required|max:240|min:3'
        ];
    }

    public function messages()
    {
        return [
            'status.in' => 'O status deve ser: agendado, confirmado, realizado ou cancelado',
            'required' => 'O :attribute do agendamento deve ser informado',
            'relatorio_consulta.max' => 'O deve ter no máximo 240 caracteres',
            'relatorio_consulta.min' => 'O deve ter no mínimo 3 caracteres'
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
