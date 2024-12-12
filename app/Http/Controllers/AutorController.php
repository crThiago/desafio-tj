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
                $request->get('page', 1),
                $request->get('itemsPerPage', 15)
            )
        );
    }

    public function store(AutorRequest $request)
    {
        DB::beginTransaction();
        try {
            $result = $this->autorService->create($request->validated());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            return $this->sendError('Ocorreu um erro ao cadastrar o autor');
        }

        return new AutorResource($result);
    }

    public function show(Autor $autor)
    {
        return new AutorResource($autor);
    }

    public function update(AutorRequest $request, Autor $autor)
    {
        DB::beginTransaction();

        try {
            $this->autorService->update($autor->CodAu, $request->validated());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            return $this->sendError('Ocorreu um erro ao atualizar o autor');
        }

        return true;
    }

    public function destroy(Autor $autor)
    {
        DB::beginTransaction();

        try {
            $this->autorService->delete($autor->CodAu);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);
            return $this->sendError('Ocorreu um erro ao excluir o autor');
        }

        return true;
    }
}
