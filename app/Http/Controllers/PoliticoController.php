<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{
    Politico
};

use App\Http\Requests\{
    CreateEditPoliticoRequest,
    DeletePoliticoRequest,
    GetPoliticoRequest
};

use App\Http\Resources\{
    PoliticoResource,
    PoliticosResource
};

use App\Http\Services\PoliticoService;


class PoliticoController extends Controller{

    public $politico_service;

    public function __construct(){
        $this->politico_service = new PoliticoService();
    }

    public function getPolitico(Politico $politico){
        return response()->json(new PoliticoResource($politico));
    }
    
    public function searchPoliticos(GetPoliticoRequest $request){
        $politicos = $this->politico_service->searchPoliticos($request);
        return response()->json((new PoliticosResource($politicos))->resolve(['is_list' => true]));
    }

    public function createPolitico(CreateEditPoliticoRequest $request){
        $new_politico = $this->politico_service->saveEditPolitico($request, null);
        if($new_politico == null){
            return response()->json(["message" => "Politico ja cadastrado"], 403);
        }
        return response()->json(new PoliticoResource($new_politico));
    }

    public function editPolitico(Politico $politico, CreateEditPoliticoRequest $request){
        $politico = $this->politico_service->saveEditPolitico($request, $politico->id);
        return response()->json(new PoliticoResource($politico));
    }

    public function deletePolitico(Politico $politico, DeletePoliticoRequest $request){
        $this->politico_service->deletePolitico($politico);
        return response()->json();
    }
    
}
