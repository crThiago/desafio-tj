<?php

namespace App\Http\Controllers;

use App\DAO\RelatorioDAO;

class RelatorioController extends Controller
{
    public function index()
    {
        return RelatorioDAO::livrosAssuntosAgrupadosPorAutor();
    }
}
