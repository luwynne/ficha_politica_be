<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProcessoRequest extends FormRequest
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
            'nome' =>[
                'required',
                'string'
            ],
            'descricao' =>[
                'required',
                'string'
            ],
            'protocolo' =>[
                'required',
                'string'
            ],
            'finalizado' =>[
                'nullable',
                'boolean'
            ],
            'culpado' =>[
                'nullable',
                'boolean'
            ],
            'mandato_id' =>[
                'required',
                'integer',
                'exists:mandatos,id'
            ],
            'tipo_id' =>[
                'required',
                'integer',
                'exists:tipos_processos,id'
            ],
            'politico_id' =>[
                'required',
                'integer',
                'exists:politicos,id',
                'different:mandato_id'
            ]
        ];
    }
}
