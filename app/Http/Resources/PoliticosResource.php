<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PoliticosResource extends ResourceCollection
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
                return (New PoliticoOnListResource($politico));
            });
        }

        return $this->resource->map(function ($politico){
            return (New PoliticoResource($politico));
        });
    }
}
