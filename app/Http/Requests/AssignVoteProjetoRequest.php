<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MandatoValidRule;
use App\Models\{
    Projeto,
    Mandato
};

class AssignVoteProjetoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->user()->can('vote', [Projeto::class, Mandato::find(request()->input('mandato_id'))]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){

        $projeto = request()->route('projeto');

        return [
            'mandato_id' =>[
                'required',
                'exists:mandatos,id',
                //new MandatoValidRule($projeto)
            ],
            'aprova'=>[
                'required',
                'boolean'
            ]
        ];
    }
}
