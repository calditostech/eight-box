<?php

namespace App\Repositories;

use App\Models\Bebida;

class BebidaRepository extends BaseRepository
{
    public function __construct(Bebida $bebida)
    {
        parent::__construct($bebida);
    }

    public function buscarPorNome($nome)
    {
        return $this->model->where('nome', 'like', '%'.$nome.'%')->get();
    }
}
