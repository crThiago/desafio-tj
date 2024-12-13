<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssuntoRequest;
use App\Http\Resources\AssuntoResource;
use App\Http\Resources\PaginateCollection;
use App\Models\Assunto;
use App\Models\Livro;
use App\Services\AssuntoService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AssuntoController extends Controller
{
    private AssuntoService $assuntoService;

    public function __construct()
    {
        $this->assuntoService = new AssuntoService();
    }

    public function index(Request $request) {
        return new PaginateCollection(
            $this->assuntoService->list(
                $request->get('search', ''),
                $request->get('page', 1),
                $request->get('itemsPerPage', 15)
            )
        );
    }

    public function store(AssuntoRequest $request)
    {
        $result = $this->handleTransaction(function () use ($request) {
            return $this->assuntoService->create($request->validated());
        });

        return new AssuntoResource($result);
    }

    public function show(Assunto $assunto)
    {
        return new AssuntoResource($assunto);
    }

    public function update(AssuntoRequest $request, Assunto $assunto)
    {
        $this->handleTransaction(function () use ($request, $assunto) {
            $this->assuntoService->update($assunto->codAs, $request->validated());
        });

        return true;
    }

    public function destroy(Assunto $assunto)
    {
        $this->handleTransaction(function () use ( $assunto) {
            return $this->assuntoService->delete($assunto->codAs);
        });

        return true;
    }
}
