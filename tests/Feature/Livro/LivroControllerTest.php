<?php

namespace Tests\Feature\Livro;

use App\Models\Livro;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LivroControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_store_livro_success(): void
    {
        $livro = [
            'Titulo' => fake()->word(),
            'Editora' => fake()->word(),
            'AnoPublicacao' => fake()->year(),
            'Valor' => fake()->randomFloat(2, 0, 500),
        ];

        $this->post(
            route('livro.store'),
            $livro
        )
        ->assertCreated()
        ->assertJson(['data' => $livro]);
    }

    public function test_store_livro_fail_validation(): void
    {
        $livro = [
            'Titulo' => null,
            'Editora' => fake()->text(),
            'AnoPublicacao' => fake()->month(),
            'Valor' => fake()->randomFloat(2, 0, 500) * -1,
        ];

        $this->post(route('livro.store'), $livro)
            // todo ->assertStatus(422)
            ->assertSessionHasErrors(['Titulo', 'Editora', 'AnoPublicacao', 'Valor']);
    }


    public function test_show_livro(): void
    {
        $livro = Livro::factory()->create();

        $this->get(route('livro.show', ['livro' => $livro->Codl]))->assertOk();
    }

    public function test_show_livro_not_found(): void
    {
        $this->get(route('livro.show', ['livro' => 0]))->assertNotFound();
    }

    public function test_index_livros(): void
    {
        Livro::factory(100)->create();

         $this->get(route('livro.index'))
            ->assertJsonCount(15, 'data')
            ->assertJsonFragment(['total' => 100])
            ->assertOk();
    }

    public function test_index_livros_with_params(): void
    {
        Livro::factory(30)->create([
            'Titulo' => 'test_' . fake()->word()
        ]);
        Livro::factory(60)->create();

         $this->get(route('livro.index', ['itemsPerPage' => 10, 'search' => 'test', 'page' => 2]))
            ->assertJsonCount(10, 'data')
            ->assertJsonFragment(['total' => 30, 'current_page' => 2])
            ->assertOk();
    }

    public function test_update_livro(): void
    {
        $livro = Livro::factory()->create();

        $livroDados = [
            'Titulo' => fake()->word(),
            'Editora' => fake()->word(),
            'AnoPublicacao' => fake()->year(),
            'Valor' => fake()->randomFloat(2, 0, 500),
        ];

        $this->put(route('livro.update', ['livro' => $livro->Codl]), $livroDados)
            ->assertOk();
    }

    public function test_destroy_livro(): void
    {
        $livro = Livro::factory()->create();

        $this->delete(route('livro.destroy', ['livro' => $livro->Codl]))
            ->assertOk();
    }
}
