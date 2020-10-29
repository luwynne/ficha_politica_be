<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MandatosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){
        return $this->resource->map(function ($politico){
            return (new MandatoResource($politico));
        });
    }
}
