<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processo extends Model{

    use HasFactory;

    protected $table = 'processos';

    public function tipo(){
        return $this->belongsTo(TipoProcesso::class, 'tipo_id');
    }

    public function mandato(){
        return $this->belongsTo(Mandato::class, 'mandato_id');
    }

}
