<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcessoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->resource == null) {
            return;
        }

        $processo = $this->resource;
        $show_mandato_politicable = isset($request['show_mandato_politicable']) && $request['show_mandato_politicable'] == true;
        
        return [
            'id' => $processo->id,
            'nome' => $processo->nome,
            'descricao' => $processo->descricao,
            'protocolo' => $processo->protocolo,
            'finalizado' => (boolean)$processo->finalizado,
            'culpado' => (boolean)$processo->culpado,
            'tipo' => new TipoProcessoResource($processo->tipo),
            'mandato' => $show_mandato_politicable ? (new MandatoResource($processo->mandato))->resolve(['show_mandato_politicable' => true]) : new MandatoResource($processo->mandato),
            'relator' => new PoliticoResource($processo->relator, true)
        ];
    }
}
