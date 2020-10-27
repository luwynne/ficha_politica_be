<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\{
    Cidade,
    Estado
};

class CidadesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row){
        
        if (!empty($row[0]) && !empty($row[1])) {
            $estado = Estado::where('nome', 'like', '%'.$row[1].'%')->first();
            return new Cidade([
                'nome' => $row[0],
                'estado_id' => $estado ? $estado->id : null
            ]);
        }
    }
}
