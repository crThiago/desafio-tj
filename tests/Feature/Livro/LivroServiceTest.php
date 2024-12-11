<?php

namespace Tests\Feature\Livro;

use App\Models\Assunto;
use App\Models\Autor;
use App\Models\Livro;
use App\Services\LivroService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LivroServiceTest extends TestCase
{
    use RefreshDatabase;

    private LivroService $livroService;
    protected function setUp(): void
    {
        parent::setUp();

        $this->livroService = new LivroService();
    }

    public function test_create_livro(): void
    {
        $livro = $this->livroService->create([
            'Titulo' => 'Livro Teste',
            'Editora' => 'Editora Teste',
            'AnoPublicacao' => '2023',
            'Valor' => '10.00',
        ]);


        $this->assertDatabaseHas('Livro', [
            'Titulo' => $livro->Titulo,
            'Editora' => $livro->Editora,
            'AnoPublicacao' => $livro->AnoPublicacao,
            'Valor' => $livro->Valor,
        ]);
    }

    public function test_create_livro_with_relations(): void
    {
        $autores = Autor::factory(2)->create();
        $assuntos = Assunto::factory(3)->create();

        $livro = $this->livroService->create([
            'Titulo' => 'Livro Teste',
            'Editora' => 'Editora Teste',
            'AnoPublicacao' => '2023',
            'Valor' => '10.00',
            'Autores' => $autores->pluck('CodAu')->toArray(),
            'Assuntos' => $assuntos->pluck('codAs')->toArray(),
        ]);


        $this->assertDatabaseHas('Livro', [
            'Titulo' => $livro->Titulo,
            'Editora' => $livro->Editora,
            'AnoPublicacao' => $livro->AnoPublicacao,
            'Valor' => $livro->Valor,
        ]);

        $this->assertCount(2, $livro->autores);
        $this->assertCount(3, $livro->assuntos);
    }

    public function test_update_livro(): void
    {
        $livro = Livro::factory()->create();

        $this->livroService->update(
            $livro->Codl,
            [
                'Titulo' => 'Livro Teste Update',
                'Editora' => 'Editora Teste',
                'AnoPublicacao' => '2023',
                'Valor' => '10.00',
            ]
        );

        $this->assertDatabaseHas('Livro', [
            'Titulo' => 'Livro Teste Update',
            'Editora' => 'Editora Teste',
            'AnoPublicacao' => '2023',
            'Valor' => '10.00',
        ]);
    }

    public function test_update_livro_with_relations(): void
    {
        $livro = Livro::factory()->create();
        $autores = Autor::factory(2)->create();
        $assuntos = Assunto::factory(3)->create();

        $this->livroService->update(
            $livro->Codl,
            [
                'Titulo' => 'Livro Teste Update',
                'Editora' => 'Editora Teste',
                'AnoPublicacao' => '2023',
                'Valor' => '10.00',
                'Autores' => $autores->pluck('CodAu')->toArray(),
                'Assuntos' => $assuntos->pluck('codAs')->toArray(),
            ]
        );

        $this->assertDatabaseHas('Livro', [
            'Titulo' => 'Livro Teste Update',
            'Editora' => 'Editora Teste',
            'AnoPublicacao' => '2023',
            'Valor' => '10.00',
        ]);

        $this->assertCount(2, $livro->autores);
        $this->assertCount(3, $livro->assuntos);
    }

    public function test_delete_livro(): void
    {
        $livro = Livro::factory()->create();

        $this->livroService->delete($livro->Codl);

        $this->assertDatabaseMissing('Livro', ['Codl' => $livro->Codl]);
    }

    public function test_list_livros(): void
    {
        $itemsPerPage = 5;
        $page = 2;

        $livros = array_values(
            Livro::factory(40)
                ->create()
                ->load('autores', 'assuntos')
                ->skip($itemsPerPage)
                ->take($itemsPerPage)
                ->toArray()
        );

        $list = $this->livroService->list(null, $page, $itemsPerPage)->toArray();
        $this->assertCount($itemsPerPage, $list['data']);
        $this->assertEquals($page, $list['current_page']);
        $this->assertEquals(40, $list['total']);
        $this->assertEquals($list['data'], $livros);
    }

    public function test_list_livros_search_titulo(): void
    {
        Livro::factory(39)->create();
        $livroPesquisado = Livro::factory()->create(['Titulo' => 'Título Teste']);

        $list = $this->livroService->list('Título Teste')->toArray();
        $this->assertCount(1, $list['data']);
        $this->assertEquals(1, $list['total']);
        $this->assertEquals($livroPesquisado->Codl, $list['data'][0]['Codl']);
    }

    public function test_list_livros_search_editora(): void
    {
        Livro::factory(39)->create();
        $livroPesquisado = Livro::factory()->create(['Editora' => 'Editora Teste']);

        $list = $this->livroService->list('Editora Teste')->toArray();
        $this->assertCount(1, $list['data']);
        $this->assertEquals(1, $list['total']);
        $this->assertEquals($livroPesquisado->Codl, $list['data'][0]['Codl']);
    }

    public function test_list_livros_search_autor(): void
    {
        $livrosPesquisados = Livro::factory(40)->create()->take(3);
        $autorPesquisado = Autor::factory()->create(['Nome' => 'Autor Teste']);

        foreach ($livrosPesquisados as $livro) {
            $livro->autores()->attach($autorPesquisado->CodAu);
        }

        $list = $this->livroService->list('Autor Teste')->toArray();
        $this->assertCount(3, $list['data']);
        $this->assertEquals(3, $list['total']);
        $this->assertEquals($livrosPesquisados->load('autores', 'assuntos')->toArray(), $list['data']);
    }
}
