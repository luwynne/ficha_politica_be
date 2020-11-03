<?php

namespace App\Http\Services;

use App\Models\Projeto;

class ProjetoService{

    public function saveEditProjeto($request, $projeto_id){

        if($projeto_id == null){
            $projeto = new Projeto();
        }else{
            $projeto = Projeto::find($projeto_id);
        }
        
        $projeto->nome = $request->input('nome');
        $projeto->descricao = $request->input('descricao');
        $projeto->protocolo = $request->input('protocolo');
        $projeto->tipo_id = $request->input('tipo_id');
        $projeto->mandato_id = $request->input('mandato_id');
        $projeto->aprovado = false;
        $projeto->url = $request->input('url');
        $projeto->save();

        return $projeto;

    }

}