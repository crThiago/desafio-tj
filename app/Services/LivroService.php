<?php

namespace App\Services;

use App\Models\Livro;
use App\Repository;

class LivroService extends Repository
{
    public function __construct()
    {
        $this->model = new Livro();
    }

    public function list(string|null $search = '', int $page = 1, int $itemsPerPage = 15): mixed
    {
        $this->builder = $this->query();

        $this->builder->when(!empty($search), function ($query) use ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('Titulo', 'like', '%' . $search . '%')
                    ->orWhere('Editora', 'like', '%' . $search . '%')
                    ->orWhereHas('autores', function ($query) use ($search) {
                        $query->where('Nome', 'like', '%' . $search . '%');
                    });
            });
        });

        return $this->paginate($itemsPerPage, ['*'], 'page', $page);
    }
}
