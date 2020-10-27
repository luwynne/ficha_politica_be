<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cidade;
use App\Imports\CidadesImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportCidades extends Command
{
    
    protected $signature = 'cidades:import';
   
    protected $description = 'Imports all the brazilian citites into the DB';

    
    public function __construct(){
        parent::__construct();
    }

    
    public function handle(){
        Excel::import(new CidadesImport, storage_path('app/public').'/cidades.xlsx');
        return 'Import finished';
    }
}
