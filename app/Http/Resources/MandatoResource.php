<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MandatoResource extends JsonResource
{

    public function toArray($request){
        
        if ($this->resource == null) {
            return;
        }

        $mandato = $this->resource;

        $return_array = [
            'id' => $mandato->id,
            'cargo' => $mandato->politicable->cargoString(),
            'ano_inicio' => $mandato->ano_inicio,
            'ano_fim' => $mandato->ano_fim,
            'partido' => $mandato->partido->sigla,
            'projetos' => new ProjetosResource($mandato->projetos),
            'processos' => $mandato->processos,
            'politico_id' => $mandato->politico->id
        ];

        if(isset($request['show_mandato_politicable']) && $request['show_mandato_politicable'] == true){
            $return_array = array_merge($return_array, ['nome' => $mandato->politico->nome]);
        }

        return $return_array;
    }
}
