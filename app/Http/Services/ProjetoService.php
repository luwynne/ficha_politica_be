<?php

namespace App\Http\Services;

use App\Models\{
    Mandato,
    Projeto,
    VotoProjeto
};

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

    public function deleteProjeto($projeto){
        $projeto->votos->each(function($voto){
            $voto->delete();
        });
        $projeto->delete();
        return true;
    }

    public function assignVoteProjeto($projeto, $request){
        $voto_projeto = new VotoProjeto();
        $voto_projeto->projeto_id = $projeto->id;
        $voto_projeto->mandato_id = $request->input('mandato_id');
        $voto_projeto->aprova = $request->input('aprova');
        $voto_projeto->save();
        return true;
    }

    public function deleteVoteProjeto($voto_projeto){
        $voto_projeto->delete();
        return true;
    }

}