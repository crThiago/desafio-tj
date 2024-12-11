<?php

namespace App\Services;

use App\Models\Assunto;
use App\Repository;

class AssuntoService extends Repository
{
    public function __construct()
    {
        $this->model = new Assunto();
    }

    public function list(string|null $search = '', int $page = 1, int $itemsPerPage = 15): mixed
    {
        $this->builder = $this->query();

        $this->builder->withCount('livros');
        $this->builder->when(!empty($search), function ($query) use ($search) {
            return $query->where('Descricao', 'like', '%' . $search . '%');
        });

        return $this->paginate($itemsPerPage, ['*'], 'page', $page);
    }
}
