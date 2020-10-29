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
            'data_nscimento' => $politico->data_nascimento,
            'mandatos' => new MandatosResource($politico->mandatos),
        ];
    }
}