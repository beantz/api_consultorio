<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidationUsersStore extends FormRequest
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
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:15'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute precisa ser prenchido',
            'name.min' => 'O campo nome só aceita no mínimo 3 caracteres',
            'name.max' => 'O campo nome só aceita no máximo 40 caracteres',
            'password.min' => 'O campo senha só aceita no mínimo 8 caracteres',
            'password.max' => 'O campo senha só aceita no máximo 15 caracteres',
            'email.email' => 'E-mail inválido',
            'email.unique' => 'O e-mail inserido já está cadastrado a outro usuário',
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
