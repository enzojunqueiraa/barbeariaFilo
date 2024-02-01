<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PagamentoUpdateFormRequest extends FormRequest
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
            
            'nome' => 'max:25|unique:pagamentos,nome,' . $this->id,
            'taxa' => 'max:25',
            'status' => 'max:11|boolean'
        ];
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }

    public function messages(){
        return [
          
            'nome.max' => 'Máximo de caracteres é 25',
            'nome.unique' => 'Nome ja cadastrado',

           
            'taxa.max' => 'Máximo de caracteres é 25',

            
            'status.boolean' => 'Formato somente em boolean',
            'status.max' => 'Máximo de caracteres é 11'
        

        ];
    }
}
