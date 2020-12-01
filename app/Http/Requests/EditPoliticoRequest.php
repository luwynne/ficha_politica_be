<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditPoliticoRequest extends FormRequest
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

        $mandatos = collect(request()->input('mandatos'));

        $rules_array = [
            'nome'=>[
                'required',
                'string'
            ],
            'data_nascimento' =>[
                'nullable',
                'string'
            ],
            'mandatos'=>[
                'nullable',
                'array'
            ],
            'mandatos.*.partido_id'=>[
                'required',
                'integer',
                'exists:partidos,id'
            ],
            'mandatos.*.politicable_type_id'=>[
                'required',
                'integer',
                'exists:politicable_tipos,id'
            ],
            'mandatos.*.ano_inicio'=>[
                'required',
                'string'
            ],
            'mandatos.*.ano_fim'=>[
                'nullable',
                'string'
            ],
            'image' =>[
                'nullable'
            ]
        ];

        $mandatos->each(function ($mandato, $key) use (&$rules_array) {
            $politicable_type_id = $mandato['politicable_type_id'];
            $rules_array = array_merge($rules_array, [
                'mandatos.'.$key.'.cidade_id'=>[
                    'nullable',
                    'integer',
                    'exists:cidades,id',
                    Rule::requiredIf(function () use ($politicable_type_id) {
                        return $politicable_type_id == 1 || $politicable_type_id == 2;
                    }),
                ],
                'mandatos.'.$key.'.estado_id'=>[
                    'nullable',
                    'integer',
                    'exists:estados,id',
                    Rule::requiredIf(function () use ($politicable_type_id) {
                        return $politicable_type_id == 3 || $politicable_type_id == 4;
                    }),
                ],
                'mandatos.'.$key.'.ministerio_id'=>[
                    'nullable',
                    'integer',
                    'exists:ministerios,id',
                    Rule::requiredIf(function () use ($politicable_type_id) {
                        return $politicable_type_id == 7;
                    }),
                ]
            ]);
        });

        return $rules_array;
    }
}
