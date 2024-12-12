<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function sendError(
        string $message = 'Ocorreu um erro um erro interno, tente novamente mais tarde',
        int $code = 500
    ) {
        return response()->json(['message' => $message], $code);
    }
}
