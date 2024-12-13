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

        $result = $this->handleTransaction(function () use ($request) {
            return $this->livroService->create($request->validated());
        });

        return new LivroResource($result);
    }


    public function update(LivroRequest $request, Livro $livro) {

        $this->handleTransaction(function () use ($request, $livro) {
            $this->livroService->update($livro->Codl, $request->validated());
        });

        return true;
    }

    public function destroy(Livro $livro)
    {
        $this->handleTransaction(function () use ($livro) {
            $this->livroService->delete($livro->Codl);
        });

        return true;
    }
}
