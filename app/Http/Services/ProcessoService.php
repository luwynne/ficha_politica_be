<?php 

namespace App\Http\Services;

use App\Models\Processo;

class ProcessoService{

    public function searchProcessess($request){
        $data = json_decode(json_encode($request->all()));
        $param = optional($data)->param;
        
        $processos = Processo::where(function($q) use($param){
            $q->where('nome', 'like', '%'.$param.'%')
              ->orWhere('protocolo', 'like', '%'.$param.'%')
              ->orWhereHas('mandato', function($q) use($param){
                  $q->whereHas('politico', function($q) use($param){
                      $q->where('nome', 'like', '%'.$param.'%');
                  });
              })
              ->orWhereHas('relator', function($q) use($param){
                 $q->where('nome', 'like', '%'.$param.'%');
              });
        })->orderBy('nome', 'ASC')->get();

        return $processos;
    }

    public function saveEditProcesso($request, $processo_id){
        
        if($processo_id == null){
            $processo = new Processo();
        }else{
            $processo = Processo::find($processo_id);
        }

        $processo->nome = $request->input('nome');
        $processo->descricao = $request->input('descricao');
        $processo->protocolo = $request->input('protocolo');
        $processo->finalizado = $request->input('finalizado') !== null ? $request->input('finalizado') : false;
        $processo->culpado = $request->input('culpado') !== null ? $request->input('culpado') : false;
        $processo->mandato_id = $request->input('mandato_id');
        $processo->tipo_id = $request->input('tipo_id');
        $processo->politico_id = $request->input('politico_id');
        $processo->save();

        $processo->refresh();

        return $processo;

    }

    public function deleteProcesso($processo){
        $processo->delete();
        return true;
    }

}