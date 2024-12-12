<?php

namespace Tests\Feature\Autor;

use App\Models\Autor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutorControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_store_autor_success(): void
    {
        $autor = ['Nome' => fake()->name()];

        $this->post(route('autor.store'), $autor)
            ->assertCreated()
            ->assertJson(['data' => $autor]);
    }

    public function test_store_autor_fail_validation(): void
    {
        $autor = ['Nome' => fake()->text()];


        $this->post(route('autor.store'), $autor)
            ->assertSessionHasErrors(['Nome']);
    }

    public function test_show_autor()
    {
        $autor = Autor::factory()->create();

        $this->get(route('autor.show', ['autor' => $autor->CodAu]))->assertOk();
    }

    public function test_index_autores(): void
    {
        Autor::factory(100)->create();

        $this->get(route('autor.index'))
            ->assertJsonCount(15, 'data')
            ->assertJsonFragment(['total' => 100])
            ->assertOk();
    }

    public function test_index_autores_with_params(): void
    {
        Autor::factory(30)->create([
            'Nome' => 'test_' . fake()->word()
        ]);
        Autor::factory(60)->create();

        $response = $this->get(route('autor.index', ['itemsPerPage' => 10, 'search' => 'test', 'page' => 2]))
            ->assertJsonCount(10, 'data')
            ->assertJsonFragment(['total' => 30, 'current_page' => 2])
            ->assertOk();
    }

    public function test_show_autor_not_found(): void
    {
        $this->get(route('autor.show', ['autor' => 0]))->assertNotFound();
    }

    public function test_update_autor(): void
    {
        $autor = Autor::factory()->create();

        $autorDados = ['Nome' => fake()->word()];

        $this->put(route('autor.update', ['autor' => $autor->CodAu]), $autorDados)
            ->assertOk();
    }

    public function test_destroy_autor(): void
    {
        $autor = Autor::factory()->create();

        $this->delete(route('autor.destroy', ['autor' => $autor->CodAu]))
            ->assertOk();
    }

}
