<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Projeto;

use App\Http\Requests\{
    CreateEditProjetoRequest
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

    public function createProjeto(CreateEditProjetoRequest $request){
        $projeto = $this->projeto_service->saveEditProjeto($request, null);
        return response()->json(new ProjetoResource($projeto));
    }

    public function editProjeto(Projeto $projeto, CreateEditProjetoRequest $request){
        $projeto = $this->projeto_service->saveEditProjeto($request, $projeto->id);
        return response()->json(new ProjetoResource($projeto));
    }
    
}
