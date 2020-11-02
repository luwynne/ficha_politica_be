<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcessoOnListResource extends JsonResource
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

        $process = $this->resource;

        return [
            'id' => $process->id,
            'nome' => $process->nome,
            'protocolo' => $process->protocolo
        ];
    }
}
