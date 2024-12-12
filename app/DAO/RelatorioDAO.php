<?php

namespace App\DAO;

use Illuminate\Support\Facades\DB;

class RelatorioDAO
{
    public static function livrosAssuntosAgrupadosPorAutor()
    {
        return DB::table('RelatorioLivrosAssuntosAgrupadosPorAutor')->paginate();
    }
}
