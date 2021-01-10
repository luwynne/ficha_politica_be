<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjetoResource extends JsonResource
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

        $projeto = $this->resource;

        $show_mandato_politicable = isset($request['show_mandato_politicable']) && $request['show_mandato_politicable'] == true;

        return [
            'id' => $projeto->id,
            'nome' => $projeto->nome,
            'descricao' => $projeto->descricao,
            'protocolo' => $projeto->protocolo,
            'aprovado' => $projeto->aprovado === null ? null : (boolean)$projeto->aprovado,
            'tipo' => new TipoProjetoResource($projeto->tipo),
            'relator' => $show_mandato_politicable ? (new MandatoResource($projeto->mandato))->resolve(['show_mandato_politicable' => true]) : null,
            'total_votos' => $projeto->votos->count()
        ];

    }
}
