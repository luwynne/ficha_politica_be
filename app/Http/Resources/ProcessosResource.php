<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcessosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){

        $is_list = isset($request['is_list']) && $request['is_list'] == true;
        
        if($is_list){
            return $this->resource->map(function ($politico){
                return (New ProcessoOnListResource($politico));
            });
        }

        return $this->resource->map(function ($politico){
            return (New ProcessoResource($politico));
        });
    }
}
