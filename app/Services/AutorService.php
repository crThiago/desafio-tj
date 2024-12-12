<?php

namespace App\Services;

use App\Models\Autor;
use App\Repository;

class AutorService extends Repository
{
    public function __construct()
    {
        $this->model = new Autor();
    }

    public function list(string|null $search = '', int $page = 1, int $itemsPerPage = 15): mixed
    {
        $this->builder = $this->query();

        $this->builder->withCount('livros');
        $this->builder->when(!empty($search), function ($query) use ($search) {
            return $query->where('Nome', 'like', '%' . $search . '%');
        });

        return $this->paginate($itemsPerPage, ['*'], 'page', $page);
    }
}
