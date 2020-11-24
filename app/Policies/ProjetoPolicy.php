<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Mandato;

class ProjetoPolicy
{
    use HandlesAuthorization;

    public function vote($user, $mandato){
        $projeto = request()->route('projeto');
        return $mandato->votos_projetos->where('projeto_id', $projeto->id)->count() == 0;
    }

}
