<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefeito extends Model{

    use HasFactory;

    protected $table = 'prefeitos';

    public function cidade(){
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function cargoString(){
        return 'Prefeito - '.$this->cidade->nome;
    }

}
