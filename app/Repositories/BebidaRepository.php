<?php

namespace App\Repositories;

use App\Models\Bebida;

class BebidaRepository extends BaseRepository
{
    public function __construct(Bebida $bebida)
    {
        parent::__construct($bebida);
    }

    public function filters($tipo, $marca, $preco)
    {
        $query = $this->model->query();

        if ($tipo) {
            $query->where('tipo', 'like', "%$tipo%");
        }

        if ($marca) {
            $query->where('marca', 'like', "%$marca%");
        }

        if ($preco) {
            $query->where('preco', 'like', "%$preco%");
        }

        return $query->get();
    }
}
