<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governador extends Model{
    
    use HasFactory;

    protected $table = 'governadores';

    public function estado(){
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function cargoString(){
        return 'Governador - '.$this->estado->nome;
    }

}
