<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use phpDocumentor\Reflection\Types\Boolean;

class ValidationPacientes extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
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
            'nome' => 'required|min:3|max:40',
            'idade' => 'numeric',
            'contato' => 'required|numeric',
            'alergias' => 'max:100',
            'medicamentos_usados' => 'max:100'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute precisa ser prenchido',
            'nome.min' => 'O campo nome só aceita no mínimo 3 caracteres',
            'nome.max' => 'O campo nome só aceita no máximo 40 caracteres',
            'idade.numeric' => 'O campo idade só aceita dados numéricos',
            'contato.numeric' => 'O campo contato só aceita dados numéricos',
            'alergias.max' => 'O campo nome só aceita no máximo 100 caracteres',
            'medicamentos_usados.max' => 'O campo medicamentos usados só aceita no máximo 100 caracteres',
        ];
    }

    //personalizando o faledValidation que é gerado automaticamento quando se usa o form request, pra ele da um retorno diferente caso haja algum erro
    protected function failedValidation(Validator $validator) {

        throw new HttpResponseException(
            
            response()->json([
                'message' => 'Erro de validação',
                'errors' => $validator->errors(),
            ], 422)

        );
    }
}
