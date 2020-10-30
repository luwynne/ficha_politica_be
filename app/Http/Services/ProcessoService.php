<?php 

namespace App\Http\Services;

use App\Models\Processo;

class ProcessoService{

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

}