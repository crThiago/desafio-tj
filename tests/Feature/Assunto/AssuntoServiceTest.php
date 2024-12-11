<?php

namespace Tests\Feature\Assunto;

use App\Models\Assunto;
use App\Services\AssuntoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssuntoServiceTest extends TestCase
{
    use RefreshDatabase;

    private AssuntoService $assuntoService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->assuntoService = new AssuntoService();
    }

    /**
     * A basic feature test example.
     */
    public function test_create_assunto(): void
    {
        $assunto = $this->assuntoService->create(['Descricao' => 'Assunto Teste']);

        $this->assertDatabaseHas('Assunto', ['Descricao' => $assunto->Descricao]);
    }

    public function test_update_assunto(): void
    {
        $assunto = Assunto::factory()->create();


        $this->assuntoService->update($assunto->codAs, ['Descricao' => 'Assunto Teste Update']);

        $this->assertDatabaseHas('Assunto', ['Descricao' => 'Assunto Teste Update']);
    }

    public function test_delete_assunto(): void
    {
        $assunto = Assunto::factory()->create();

        $this->assuntoService->delete($assunto->codAs);

        $this->assertDatabaseMissing('Assunto', ['codAs' => $assunto->codAs]);
    }

    public function test_list_assunto(): void
    {
        $itemsPerPage = 5;
        $page = 2;

        Assunto::factory(40)->create();

        $list = $this->assuntoService->list(null, $page, $itemsPerPage)->toArray();
        $this->assertCount($itemsPerPage, $list['data']);
        $this->assertEquals($page, $list['current_page']);
        $this->assertEquals(40, $list['total']);
    }

    public function test_list_assunto_search_descricao(): void
    {
        Assunto::factory(39)->create();
        $assuntoPesquisado = Assunto::factory()->create(['Descricao' => 'Descricao Teste']);

        $list = $this->assuntoService->list('Descricao Teste')->toArray();
        $this->assertCount(1, $list['data']);
        $this->assertEquals(1, $list['total']);
        $this->assertEquals($assuntoPesquisado->codAs, $list['data'][0]['codAs']);
    }
}
