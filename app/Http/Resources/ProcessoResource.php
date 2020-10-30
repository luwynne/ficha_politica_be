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
        
        return [
            'id' => $processo->id,
            'nome' => $processo->nome,
            'descricao' => $processo->descricao,
            'protocolo' => $processo->protocolo,
            'finalizado' => $processo->finalizado,
            'culpado' => $processo->culpado,
            'tipo' => new TipoProcessoResource($processo->tipo),
            'mandato' => new MandatoResource($processo->mandato),
            'relator' => new PoliticoResource($processo->relator, true)
        ];
    }
}
