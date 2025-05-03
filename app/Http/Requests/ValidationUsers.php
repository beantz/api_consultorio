<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ValidationUsers extends FormRequest
{
    use ApiResponse;

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
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute precisa ser prenchido',
            'email.email' => 'O e-mail é inválido',
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
