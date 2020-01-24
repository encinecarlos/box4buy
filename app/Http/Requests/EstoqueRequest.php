<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstoqueRequest extends FormRequest
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
            'descricao' => 'required',
            'datacompra' => 'required',
            'quantidade' => 'required|numeric|min:1',
            'codigorastreio' => 'required',
            'siteloja' => 'required',
            'nomeloja' => 'required'
        ];
    }
}
