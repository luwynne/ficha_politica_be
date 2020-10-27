<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PoliticoOnListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){

        if ($this->resource == null) {
            return;
        }

        $politico = $this->resource;
        $atual_mandato = $politico->mandatos()->orderBy('ano_inicio','DESC')->first();

        return [
            'nome' => $politico->nome,
            'atual_mandato' => $atual_mandato ? [
                'cargo' => $atual_mandato->politicable->cargoString(),
                'ano_inicio' => $atual_mandato->ano_inicio,
                'ano_fim' => $atual_mandato->ano_fim,
                'partido' => $atual_mandato->partido->sigla
            ] : null
        ];

    }
}
