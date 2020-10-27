<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Senador extends Model{

    use HasFactory;

    protected $table = 'senadores';

    public function cargoString(){
        return 'Senador Federal';
    }
    
}
