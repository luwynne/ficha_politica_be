<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoProjetoResource extends JsonResource
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

        $tipo_projeto = $this->resource;

        return [
            'id' => $tipo_projeto->id,
            'nome' => $tipo_projeto->nome
        ];
    }
}
