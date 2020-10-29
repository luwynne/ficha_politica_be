<?php

namespace App\Http\Services;

use App\Models\{
    Mandato,
    Politico,
    PoliticableTipo,
    Prefeito,
    Verador,
    Governador,
    DeputadoEstadual,
    DeputadoFederal,
    Senador,
    Ministro,
    Presidente
};

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
        })->where('aprovado', true)->orderBy('nome', 'ASC')->get();

        return $politicos;
    }

    
    public function saveEditPolitico($request, $politico_id){

        $politico = Politico::find($politico_id);
        
        if($politico_id == null){
            $politico = new Politico();
            $existing_politico = Politico::where('nome', $request->input('nome'))->first();
        }else{
            $politico = Politico::find($politico_id);
            $existing_politico = null;
        }

        if(!$existing_politico == null){
            return null;
        }

        $politico->nome = $request->input('nome');
        $politico->data_nascimento = $request->input('data_nascimento');
        $politico->aprovado = false;
        $politico->save();

        if(!empty($request->input('mandatos'))){
            $this->_saveMandatos($request->input('mandatos'), $politico);
        }

        $politico->refresh();
        return $politico;
    }


    private function _saveMandatos($mandatos, $politico){

        // Deleting the mandatos in order to recreate the ones comming from the payload
        if($politico->mandatos->count() > 0){
            $politico->mandatos->each(function($mandato){
                $politicable = $mandato->politicable;
                $mandato->delete();
                $politicable->delete();
            });
        }

        $mandatos = collect($mandatos);

        $mandatos->each(function($mandato) use($politico){
            
            $politicable_class = PoliticableTipo::find($mandato['politicable_type_id'])->nome_classe;
            $politicable_obj = $this->_savePoliticable($politicable_class, $mandato);
            
            $mandato_obj = new Mandato();
            $mandato_obj->partido_id = $mandato['partido_id'];
            $mandato_obj->politico_id = $politico->id;
            $mandato_obj->politicable_id = $politicable_obj->id;
            $mandato_obj->politicable_type = $politicable_class;
            $mandato_obj->ano_inicio = $mandato['ano_inicio'];
            $mandato_obj->ano_fim = $mandato['ano_fim'];
            $mandato_obj->save();
        });
    }

    
    private function _savePoliticable($class, $request){
        
        $politicable_object = new $class;
        
        if(class_basename($politicable_object) == class_basename(Prefeito::class) || class_basename($politicable_object) == class_basename(Vereador::class)){
            $politicable_object->cidade_id = $request['cidade_id'];
        }elseif(class_basename($politicable_object) == class_basename(Governador::class) || class_basename($politicable_object) == class_basename(DeputadoEstadual::class)){
            $politicable_object->estado_id = $request['estado_id'];
        }elseif(class_basename($politicable_object) == class_basename(Ministro::class)){
            $politicable_object->ministerio_id = $request['ministerio_id'];
        }
        
        $politicable_object->save();

        return $politicable_object;
    }

}