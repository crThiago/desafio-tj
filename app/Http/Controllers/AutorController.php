<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutorRequest;
use App\Http\Resources\AutorResource;
use App\Http\Resources\PaginateCollection;
use App\Models\Autor;
use App\Services\AutorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutorController extends Controller
{
    private $autorService;

    public function __construct()
    {
        $this->autorService = new AutorService();
    }

    public function index(Request $request) {
        return new PaginateCollection(
            $this->autorService->list(
                $request->get('search', ''),
                $request->get('sortBy', []),
                $request->get('page', 1),
                $request->get('itemsPerPage', 15)
            )
        );
    }

    public function store(AutorRequest $request)
    {
        $result = $this->handleTransaction(function () use ($request) {
            return $this->autorService->create($request->validated());
        });

        return new AutorResource($result);
    }

    public function show(Autor $autor)
    {
        return new AutorResource($autor);
    }

    public function update(AutorRequest $request, Autor $autor)
    {
        $this->handleTransaction(function () use ($request, $autor) {
            $this->autorService->update($autor->CodAu, $request->validated());
        });

        return true;
    }

    public function destroy(Autor $autor)
    {
        $this->handleTransaction(function () use ($autor) {
            $this->autorService->delete($autor->CodAu);
        });

        return true;
    }
}
