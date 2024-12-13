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
                    })
                    ->orWhereHas('assuntos', function ($query) use ($search) {
                        $query->where('Descricao', 'like', '%' . $search . '%');
                    });
            });
        });

        $this->builder->orderBy('Titulo');

        return $this->paginate($itemsPerPage, ['*'], 'page', $page);
    }

    public function create(array $data): mixed
    {
        $livro = parent::create($data);

        if (!empty($data['Autores'])) {
            $livro->autores()->attach($data['Autores']);
        }

        if (!empty($data['Assuntos'])) {
            $livro->assuntos()->attach($data['Assuntos']);
        }

        return $livro;
    }

    public function update(int $id, array $data): mixed
    {
        $livro = $this->find($id);

        $livro->update($data);

        if (!empty($data['Autores'])) {
            $livro->autores()->sync($data['Autores']);
        }

        if (!empty($data['Assuntos'])) {
            $livro->assuntos()->sync($data['Assuntos']);
        }

        return true;
    }

}
