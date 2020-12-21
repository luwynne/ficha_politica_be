<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    Mandato,
    Projeto,
    VotoProjeto
};

use App\Http\Requests\{
    CreateEditProjetoRequest,
    AssignVoteProjetoRequest,
    DeleteProjetoRequest,
    DeleteVotoProjetoRequest
};

use App\Http\Resources\{
    ProjetoResource,
    ProjetosResource,
    ProjetosOnListResource
};

use App\Http\Services\ProjetoService;

class ProjetoController extends Controller{

    public $projeto_service;
    
    public function __construct(){
        $this->projeto_service = new ProjetoService();
    }

    public function searchProjects(Request $request){
        $projetos = $this->projeto_service->searchProjects($request);
        return response()->json((new ProjetosResource($projetos)));
    }

    public function getProjeto(Projeto $projeto){
        return response()->json((new ProjetoResource($projeto))->resolve(['show_mandato_politicable' => true]));
    }

    public function createProjeto(CreateEditProjetoRequest $request){
        $projeto = $this->projeto_service->saveEditProjeto($request, null);
        return response()->json((new ProjetoResource($projeto))->resolve(['show_mandato_politicable' => true]));
    }

    public function editProjeto(Projeto $projeto, CreateEditProjetoRequest $request){
        $projeto = $this->projeto_service->saveEditProjeto($request, $projeto->id);
        return response()->json((new ProjetoResource($projeto))->resolve(['show_mandato_politicable' => true]));
    }

    public function deleteProjeto(Projeto $projeto, DeleteProjetoRequest $request){
        $this->projeto_service->deleteProjeto($projeto);
        return response()->json();
    }

    public function assignVoteProjeto(Projeto $projeto, AssignVoteProjetoRequest $request){
        $this->projeto_service->assignVoteProjeto($projeto, $request);
        return response()->json((new ProjetoResource($projeto))->resolve(['show_mandato_politicable' => true]));
    }

    public function deleteVotoProjeto(VotoProjeto $voto_projeto, DeleteVotoProjetoRequest $request){
        $projeto = $voto_projeto->projeto;
        $this->projeto_service->deleteVoteProjeto($voto_projeto);
        return response()->json((new ProjetoResource($projeto))->resolve(['show_mandato_politicable' => true]));
    }
    
}
