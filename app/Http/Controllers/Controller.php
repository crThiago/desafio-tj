<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

abstract class Controller
{
    protected function handleTransaction(callable $callback)
    {
        try {
            DB::beginTransaction();
            $result = $callback();
            DB::commit();
            return $result;
        } catch (\PDOException $e) {
            DB::rollBack();
            \Log::error('Erro no banco de dados', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw new \Exception('Erro no banco de dados por favor tente novamente mais tarde');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Erro inesperado', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            throw new \Exception('Ocorreu um erro um erro interno, tente novamente mais tarde');
        }
    }
}
