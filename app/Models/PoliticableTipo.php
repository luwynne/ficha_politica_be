<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticableTipo extends Model
{
    use HasFactory;

    protected $table = 'politicable_tipos';

    public $timestamps = false;
}
