<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ProcessoService;

use App\Models\Processo;

use App\Http\Requests\{
    CreateProcessoRequest,
    DeleteProcessoRequest,
    EditProcessoRequest,
    GetProcessRequest
};

use App\Http\Resources\{
    ProcessoResource,
    ProcessosResource,
    ProcessoOnListResource
};

class ProcessoController extends Controller{

    public $processo_service;

    public function __construct(){
        $this->processo_service = new ProcessoService();
    }

    public function getProcesso(Processo $processo){
        return response()->json((new ProcessoResource($processo))->resolve(['show_mandato_politicable' => true]));
    }

    public function searchProcessess(GetProcessRequest $request){
        $processos = $this->processo_service->searchProcessess($request);
        return response()->json((new ProcessosResource($processos))->resolve(['is_list' => true]));
    }

    public function createProcesso(CreateProcessoRequest $request){
        $processo = $this->processo_service->saveEditProcesso($request, null);
        return response()->json(new ProcessoResource($processo));
    }

    public function editProcesso(Processo $processo, EditProcessoRequest $request){
        $processo = $this->processo_service->saveEditProcesso($request, $processo->id);
        return response()->json(new ProcessoResource($processo));
    }

    public function deleteProcesso(DeleteProcessoRequest $request, Processo $processo){
        $this->processo_service->deleteProcesso($processo);
        return response()->json();
    }
    
}
