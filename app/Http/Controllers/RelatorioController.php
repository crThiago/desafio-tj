<?php

namespace App\Http\Controllers;

use App\DAO\RelatorioDAO;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function index(Request $request)
    {
        return RelatorioDAO::livrosAssuntosAgrupadosPorAutor($request->get('page', 1), $request->get('itemsPerPage', 15));
    }
}
