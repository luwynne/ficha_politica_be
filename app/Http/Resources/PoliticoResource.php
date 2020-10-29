<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PoliticoResource extends JsonResource
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

        return [
            'id' => $politico->id,
            'nome' => $politico->nome,
            'data_nascimento' => $politico->data_nascimento,
            "descricao" => $politico->descricao,
            'mandatos' => new MandatosResource($politico->mandatos),
        ];
    }
}
