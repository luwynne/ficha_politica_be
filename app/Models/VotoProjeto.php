<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotoProjeto extends Model{

    use HasFactory;

    public function projeto(){
        return $this->belongsTo(Projeto::class, 'projeto_id');
    }

    public function mandato(){
        return $this->belongsTo(Mandato::class, 'mandato_id');
    }

}
