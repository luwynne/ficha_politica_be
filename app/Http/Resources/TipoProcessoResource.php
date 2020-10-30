<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoProcessoResource extends JsonResource
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

        $tipo_processo = $this->resource;

        return [
            'id' => $tipo_processo->id,
            'nome' => $tipo_processo->nome
        ];
    }
}
