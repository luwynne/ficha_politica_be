<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vereador extends Model{
    
    use HasFactory;

    protected $table = 'vereadores';

    public function cidade(){
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function cargoString(){
        return 'Vereador - '.$this->cidade->nome;
    }

}
