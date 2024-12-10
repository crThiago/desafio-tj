<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Http\Resources\LivroResource;
use App\Http\Resources\PaginateCollection;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LivroController extends Controller
{
    public function index(Request $request) {
        $query = Livro::query();

        $query->when($request->has('search'), function ($search) use ($request) {
            return $search->where(function ($query) use ($request) {
                $query->where('Titulo', 'like', '%' . $request->search . '%')
                    ->orWhere('Editora', 'like', '%' . $request->search . '%')
                    ->orWhereHas('autores', function ($query) use ($request) {
                        $query->where('Nome', 'like', '%' . $request->search . '%');
                    });
            });
        });

        return new PaginateCollection($query->paginate($request->itemsPerPage));
    }

    public function show(Livro $livro) {
        return new LivroResource($livro);
    }

    public function store(LivroRequest $request) {
        DB::beginTransaction();

        try {
             $result = Livro::create($request->validated());
             DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            return $this->sendError('Ocorreu um erro ao cadastrar o livro');
        }

        return new LivroResource($result);
    }


    public function update(LivroRequest $request, Livro $livro) {
        DB::beginTransaction();

        try {
            $livro->update($request->validated());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            return $this->sendError('Ocorreu um erro ao atualizar o livro');
        }

        return new LivroResource($livro);
    }
}
