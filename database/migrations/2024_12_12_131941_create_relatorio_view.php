<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("DROP VIEW IF EXISTS RelatorioLivrosAssuntosAgrupadosPorAutor");

        DB::statement(
            "CREATE VIEW RelatorioLivrosAssuntosAgrupadosPorAutor AS
            SELECT
                a.Nome AS AutorNome,
                l.Titulo AS LivroTitulo,
                l.Editora AS LivroEditora,
                l.AnoPublicacao AS LivroAnoPublicacao,
                l.Valor AS LivroValor,
                GROUP_CONCAT(DISTINCT ass.Descricao ORDER BY ass.Descricao ASC SEPARATOR ', ') AS Assuntos
            FROM
                Autor a
                    LEFT JOIN Livro_Autor la ON a.CodAu = la.Autor_CodAu
                    LEFT JOIN Livro l ON la.Livro_Codl = l.Codl
                    LEFT JOIN Livro_Assunto las ON l.Codl = las.Livro_Codl
                    LEFT JOIN Assunto ass ON las.Assunto_CodAs = ass.CodAs
            GROUP BY a.CodAu, l.Codl
            ORDER BY a.Nome;"
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS RelatorioLivrosAssuntosAgrupadosPorAutor");
    }
};
