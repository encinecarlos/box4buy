<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

    public function messages()
    {
        return [
            'email.unique' => 'Já existe um usuário cadastrado com este endereço de e-mail'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '_nome' => 'required',
            '_sobrenome' => 'required',
            'email' => 'required|unique:bxby_pessoas',
            'password' => 'required',
            'confirm-password' => 'required'
        ];
    }
}
