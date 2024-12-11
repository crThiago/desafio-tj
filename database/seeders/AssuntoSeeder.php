<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssuntoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (\DB::table('Assunto')->count() > 0) {
            return;
        }

        \DB::table('Assunto')->insert([
            ['Descricao' => 'Ficção'],
            ['Descricao' => 'Drama'],
            ['Descricao' => 'Romance'],
            ['Descricao' => 'Terror'],
            ['Descricao' => 'Suspense'],
            ['Descricao' => 'Aventura'],
            ['Descricao' => 'Comédia'],
            ['Descricao' => 'Biografia'],
            ['Descricao' => 'Não Ficção'],
            ['Descricao' => 'Infantil'],
        ]);
    }
}
