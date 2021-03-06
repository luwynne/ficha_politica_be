<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model{

    use HasFactory;

    protected $table = 'projetos';

    public function tipo(){
        return $this->belongsTo(TipoProjeto::class, 'tipo_id');
    }

    public function mandato(){
        return $this->belongsTo(Mandato::class, 'mandato_id');
    }

    public function votos(){
        return $this->hasMany(VotoProjeto::class, 'projeto_id');
    }

}
