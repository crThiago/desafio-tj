<?php

namespace App\DAO;

use Illuminate\Support\Facades\DB;

class RelatorioDAO
{
    public static function livrosAssuntosAgrupadosPorAutor(int $page = 1, int $itemsPerPage = 15)
    {
        return DB::table('RelatorioLivrosAssuntosAgrupadosPorAutor')
            ->paginate($itemsPerPage, ['*'], 'page', $page);
    }
}
