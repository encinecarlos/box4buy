<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '_nome'    => 'required',
            'email'    => 'required|unique:bxby_pessoas',
            'celular'  => 'required',
            'endereco' => 'required',            
            'bairro'   => 'required',
            'cidade'   => 'required',            
        ];
    }

    public function messages()
    {
        return [
            '_nome.required' => 'O campo Nome é de preenchimento obrigatório',
            'email.required' => 'O campo E-mail é de preenchimento obrigatório',
            'email.unique' => 'E-mail Já esta cadastrado em nosso sistema',
            'celular.required' => 'O Telefone é de preenchimento obrigatório',
            'endereco.required' => 'O campo Endereço é de preenchimento obrigatório',            
            'bairro.required' => 'O campo Bairro é de preenchimento obrigatório',
            'cidade.required' => 'O campo Cidade é de preenchimento obrigatório',
            // 'uf.required' => 'O campo UF é de preenchimento obrigatório'
        ];
    }
}
