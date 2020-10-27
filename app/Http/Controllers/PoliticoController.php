<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\{
    GetPoliticoRequest
};
use App\Http\Services\PoliticoService;
use App\Http\Resources\{
    PoliticoResource,
    PoliticosResource
};


class PoliticoController extends Controller{

    public $politico_service;

    public function __construct(){
        $this->politico_service = new PoliticoService();
    }

    public function searchPoliticos(GetPoliticoRequest $request){
        $politicos = $this->politico_service->searchPoliticos($request);
        return response()->json((new PoliticosResource($politicos))->resolve(['is_list' => true]));
    }
    
}
