<?php

namespace App\Http\Services;

use App\Models\Politico;

class PoliticoService{

    public function searchPoliticos($request){
        $data = json_decode(json_encode($request->all()));
        $param = optional($data)->param;

        $politicos = Politico::where(function($q) use($param){
            $q->where('nome', 'like', '%'.$param.'%')
              ->orWhereHas('mandatos', function($q) use($param){
                  $q->whereHas('partido', function($q) use($param){
                      $q->where('nome', 'like', '%'.$param.'%')->orWhere('sigla', $param);
                  })->orWhere('politicable_type', 'like', '%'.str_replace(' ', '', $param).'%');
              });
        })->orderBy('nome', 'ASC')->get();

        return $politicos;
    }

}