<?php

namespace App\Repositories;

use App\Models\Appetizer;

class AppetizerRepository extends BaseRepository
{
    public function __construct(Appetizer $appetizer)
    {
        parent::__construct($appetizer);
    }

    public function filters($tipo, $marca, $quantidade, $data_entrada_produto)
    {
        $query = $this->model->query();

        if ($tipo) {
            $query->where('tipo', 'like', "%$tipo%");
        }

        if ($marca) {
            $query->where('marca', 'like', "%$marca%");
        }

        if ($quantidade) {
            $query->where('preco', 'like', "%$quantidade%");
        }

        if ($data_entrada_produto) {
            $query->where('preco', 'like', "%$data_entrada_produto%");
        }

        return $query->get();
    }

    public function update(array $data, $id)
    {
        $appetizer = Appetizer::find($id);

        if ($appetizer) {
            $appetizer->update($data);
            return $appetizer; 
        } else {
            return null; 
        }
    }
}
