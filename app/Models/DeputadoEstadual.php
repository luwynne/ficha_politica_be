<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeputadoEstadual extends Model{

    use HasFactory;

    protected $table = 'deputados_estaduais';

    public function estado(){
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function cargoString(){
        return 'Deputado Estadual - '.$this->estado->nome;
    }

}
