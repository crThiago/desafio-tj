<?php

namespace App\Http\Controllers;

use App\Http\Requests\LivroRequest;
use App\Http\Resources\LivroResource;
use App\Http\Resources\PaginateCollection;
use App\Models\Livro;
use App\Services\LivroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LivroController extends Controller
{
    private LivroService $livroService;

    public function __construct() {
        $this->livroService = new LivroService();
    }

    public function index(Request $request) {
        return new PaginateCollection(
            $this->livroService->list(
                $request->get('search', ''),
                $request->get('page', 1),
                $request->get('itemsPerPage', 15)
            )
        );
    }

    public function show(Livro $livro) {
        return new LivroResource($livro);
    }

    public function store(LivroRequest $request) {
        DB::beginTransaction();

        try {
             $result = $this->livroService->create($request->validated());
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
            $this->livroService->update($livro->Codl, $request->validated());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            return $this->sendError('Ocorreu um erro ao atualizar o livro');
        }

        return true;
    }

    public function destroy(Livro $livro)
    {
        DB::beginTransaction();

        try {
            $this->livroService->delete($livro->Codl);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            return $this->sendError('Ocorreu um erro ao excluir o livro');
        }

        return true;
    }
}
