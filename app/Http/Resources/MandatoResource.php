<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MandatoResource extends JsonResource
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

        $mandato = $this->resource;

        return[
            'cargo' => $mandato->politicable->cargoString(),
            'ano_inicio' => $mandato->ano_inicio,
            'ano_fim' => $mandato->ano_fim,
            'partido' => $mandato->partido->sigla
        ];
    }
}
