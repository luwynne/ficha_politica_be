<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Politico extends Model{

    use HasFactory;

    protected $table = 'politicos';

    public function mandatos(){
        return $this->hasMany(Mandato::class, 'politico_id');
    }
    
}
