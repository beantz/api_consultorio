<?php

namespace App\Http\Requests;

use App\Enums\Users;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

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
            'nome' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:15',
            'idade' => 'numeric',
            'telefone' => 'required|numeric',
            'alergias' => 'max:100',
            'usando_medicamentos' => 'max:100',
            //verifica se o user_type fornecido existe no enum
            'tipo_usuario' => ['required', Rule::in(array_column(Users::cases(), 'value'))]
        ];
    }

    public function messages()
    {

        return [
            'required' => 'O campo :attribute precisa ser prenchido',
            'nome.min' => 'O campo nome só aceita no mínimo 3 caracteres',
            'nome.max' => 'O campo nome só aceita no máximo 40 caracteres',
            'password.min' => 'O campo senha só aceita no mínimo 8 caracteres',
            'password.max' => 'O campo senha só aceita no máximo 15 caracteres',
            'email.email' => 'E-mail inválido',
            'email.unique' => 'O e-mail inserido já está cadastrado a outro usuário',
            'idade.numeric' => 'O campo idade só aceita dados numéricos',
            'telefone.numeric' => 'O campo contato só aceita dados numéricos',
            'alergias.max' => 'O campo nome só aceita no máximo 100 caracteres',
            'usando_medicamentos.max' => 'O campo medicamentos usados só aceita no máximo 100 caracteres',
            'tipo_usuario' => 'Tipo de usuário inválido. Valores aceitos: ' . implode(', ', Users::values()),
        ];
    }

}
