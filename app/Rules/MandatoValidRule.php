<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Mandato;
use Carbon\Carbon;

class MandatoValidRule implements Rule
{

    public $projeto;

    public function __construct($projeto){
        $this->projeto = $projeto;
    }

    public function passes($attribute, $value){
        $mandato = Mandato::find($value);
        $now = Carbon::now();
        return $mandato->ano_fim >= $now->year;
    }

    public function message()
    {
        return 'This mandato is no longer valid.';
    }
}
