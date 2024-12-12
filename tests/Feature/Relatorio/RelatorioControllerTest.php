<?php

namespace Tests\Feature\Relatorio;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelatorioControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_relatorio(): void
    {
        $this->seed();

        $this->get(route('relatorio'))
            ->assertJsonCount(15, 'data')
            ->assertJsonFragment(['total' => 40])
            ->assertOk();
    }
}
