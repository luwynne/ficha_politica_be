<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeputadoFederal extends Model{
    
    use HasFactory;

    protected $table = 'deputados_federais';

    public function cargoString(){
        return 'Deputado Federal';
    }
}
