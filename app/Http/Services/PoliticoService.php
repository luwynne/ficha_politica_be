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

use Image;

class PoliticoService{

    
    public function searchPoliticos($request){
        $data = json_decode(json_encode($request->all()));
        $param = optional($data)->param;

        $politicos = Politico::where(function($q) use($param){
            $q->where('nome', 'like', '%'.$param.'%')
              ->orWhereHas('mandatos', function($q) use($param){
                  $q->whereHas('partido', function($q) use($param){
                      $q->where('nome', 'like', '%'.$param.'%')->orWhere('sigla', 'like', '%'.$param.'%');
                  })->orWhere('politicable_type', 'like', '%'.str_replace(' ', '', $param).'%');
              });
        })->where('aprovado', true)->orderBy('nome', 'ASC')->get();

        return $politicos;
    }

    
    public function saveEditPolitico($request, $politico_id){
        
        if($politico_id == null){
            $politico = new Politico();
            $politico->aprovado = false;
        }else{
            $politico = Politico::find($politico_id);
        }

        $politico->nome = $request->input('nome');
        $politico->descricao = $request->input('descricao');
        $politico->data_nascimento = $request->input('data_nascimento');

        if(!empty($request->input('mandatos'))){
            $this->_saveMandatos($request->input('mandatos'), $politico);
        }

        if($request->get('image')){

            if($politico->image){
                $destinationpath = public_path('img/politicos/');
                $file_path = $destinationpath.$politico->image;
                unlink($file_path);
            }

            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            Image::make($request->get('image'))->save(public_path('img/politicos/').$name);

            $politico->image = $name;
        }

        $politico->save();
        $politico->refresh();
        return $politico;
    }


    private function _saveMandatos($mandatos, $politico){

        $this->_deleteMandatosPoliticable($politico);

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

        return true;
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
    
    public function deletePolitico($politico){
        $this->_deleteMandatosPoliticable($politico);
        $politico->delete();
        return true;
    }


    private function _deleteMandatosPoliticable($politico){
        if($politico->mandatos->count() > 0){
            $politico->mandatos->each(function($mandato){
                $politicable = $mandato->politicable;
                $mandato->delete();
                $politicable->delete();
            });
        }
        return true;
    }

}