<?php

namespace Tests\Feature\Assunto;

use App\Models\Assunto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AssuntoControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_store_assunto_success(): void
    {
        $assunto = ['Descricao' => fake()->word()];

        $this->post(route('assunto.store'), $assunto)
            ->assertCreated()
            ->assertJson(['data' => $assunto]);
    }

    public function test_store_assunto_fail_validation(): void
    {
        $assunto = ['Descricao' => fake()->text()];


        $this->post(route('assunto.store'), $assunto)
            ->assertSessionHasErrors(['Descricao']);
    }

    public function test_show_assunto()
    {
        $assunto = Assunto::factory()->create();

        $this->get(route('assunto.show', ['assunto' => $assunto->codAs]))->assertOk();
    }

    public function test_index_assuntos(): void
    {
        Assunto::factory(100)->create();

        $this->get(route('assunto.index'))
            ->assertJsonCount(15, 'data')
            ->assertJsonFragment(['total' => 100])
            ->assertOk();
    }

    public function test_index_assuntos_with_params(): void
    {
        Assunto::factory(30)->create([
            'Descricao' => 'test_' . fake()->word()
        ]);
        Assunto::factory(60)->create();

        $response = $this->get(route('assunto.index', ['itemsPerPage' => 10, 'search' => 'test', 'page' => 2]))
            ->assertJsonCount(10, 'data')
            ->assertJsonFragment(['total' => 30, 'current_page' => 2])
            ->assertOk();
    }

    public function test_show_assunto_not_found(): void
    {
        $this->get(route('assunto.show', ['assunto' => 0]))->assertNotFound();
    }

    public function test_update_assunto(): void
    {
        $assunto = Assunto::factory()->create();

        $assuntoDados = ['Descricao' => fake()->word()];

        $this->put(route('assunto.update', ['assunto' => $assunto->codAs]), $assuntoDados)
            ->assertOk();
    }

    public function test_destroy_assunto(): void
    {
        $assunto = Assunto::factory()->create();

        $this->delete(route('assunto.destroy', ['assunto' => $assunto->codAs]))
            ->assertOk();
    }
}
