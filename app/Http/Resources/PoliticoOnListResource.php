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
            'id' => $politico->id,
            'nome' => $politico->nome,
            'image' => $politico->image,
            'ultimo_mandato' => new MandatoResource($atual_mandato)
        ];

    }
}
