<?php

namespace Tests\Feature\Autor;

use App\Models\Autor;
use App\Services\AutorService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutorServiceTest extends TestCase
{
    use RefreshDatabase;

    private AutorService $autorService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->autorService = new AutorService();
    }

    /**
     * A basic feature test example.
     */
    public function test_create_autor(): void
    {
        $autor = $this->autorService->create(['Nome' => 'Autor Teste']);


        $this->assertDatabaseHas('Autor', ['Nome' => $autor->Nome]);
    }

    public function test_update_autor(): void
    {
        $autor = Autor::factory()->create();

        $this->autorService->update($autor->CodAu, ['Nome' => 'Autor Teste Update']);

        $this->assertDatabaseHas('Autor', ['Nome' => 'Autor Teste Update']);
    }

    public function test_delete_autor(): void
    {
        $autor = Autor::factory()->create();

        $this->autorService->delete($autor->CodAu);

        $this->assertDatabaseMissing('Autor', ['CodAu' => $autor->CodAu]);
    }

    public function test_list_autores(): void
    {
        $itemsPerPage = 5;
        $page = 2;

        Autor::factory(40)->create();

        $list = $this->autorService->list(null, [], $page, $itemsPerPage)->toArray();
        $this->assertCount($itemsPerPage, $list['data']);
        $this->assertEquals($page, $list['current_page']);
        $this->assertEquals(40, $list['total']);
    }

    public function test_list_autores_search_nome(): void
    {
        Autor::factory(39)->create();
        $autorPesquisado = Autor::factory()->create(['Nome' => 'Nome Teste']);

        $list = $this->autorService->list('Nome Teste')->toArray();
        $this->assertCount(1, $list['data']);
        $this->assertEquals(1, $list['total']);
        $this->assertEquals($autorPesquisado->CodAu, $list['data'][0]['CodAu']);
    }

    public function test_list_autores_order_by_nome(): void
    {
        $autores = Autor::factory(40)->create();

        $list = $this->autorService->list('', [['key' => 'Nome', 'order' => 'desc']])->toArray();
        $this->assertEquals($autores->sortByDesc('Nome')->first()->CodAu, $list['data'][0]['CodAu']);
    }
}
