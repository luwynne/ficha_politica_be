<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mandato extends Model{

    use HasFactory;

    protected $table = 'mandatos';

    public function politicable(){
        return $this->morphTo();
    }

    public function politico(){
        return $this->belongsTo(Politico::class, 'politico_id');
    }

    public function partido(){
        return $this->belongsTo(Partido::class, 'partido_id');
    }

    public function votos_projetos(){
        return $this->hasMany(VotoProjeto::class, 'mandato_id');
    }
}
