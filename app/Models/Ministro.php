<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministro extends Model{

    use HasFactory;

    protected $table = 'ministros';

    public function ministerio(){
        return $this->belongsTo(Ministerio::Class, 'ministerio_id');
    }

    public function cargoString(){
        return 'Ministro - '.$this->ministerio->nome;
    }
    
}
