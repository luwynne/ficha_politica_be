<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PoliticoResource extends JsonResource
{
    
    public $light;
    public $object; 

    public function _construct($object = null, $light = false){
        $this->light = $light;
        $this->object = $object;
    }

    public function toArray($request){

        if ($this->resource == null) {
            if($this->object == null){
                return;
            }
            $politico = $this->object;
        }else{
            $politico = $this->resource;
        }

        $atual_mandato = $politico->mandatos()->orderBy('ano_inicio','DESC')->first();

        $return_array = [
            'id' => $politico->id,
            'nome' => $politico->nome,
            'data_nascimento' => $politico->data_nascimento,
            "descricao" => $politico->descricao,
            'image' => $politico->image,
            'ultimo_mandato' => new MandatoResource($atual_mandato)
        ];

        if($this->light == false){
            $return_array = array_merge($return_array, ['mandatos' => new MandatosResource($politico->mandatos)]);
        }

        return $return_array;
    }
}
