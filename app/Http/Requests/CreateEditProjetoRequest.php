<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEditProjetoRequest extends FormRequest
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
            'nome' => [
                'required',
                'string'
            ],
            'descricao' => [
                'required',
                'string'
            ],
            'protocolo' => [
                'nullable',
                'string'
            ],
            'tipo_id' => [
                'required',
                'integer',
                'exists:tipo_projetos,id'
            ],
            'mandato_id' => [
                'required',
                'integer',
                'exists:mandatos,id'
            ],
            'url' => [
                'nullable',
                'string'
            ]
        ];
    }
}
