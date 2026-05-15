<?php

namespace Tests\Feature;

use App\Models\Paciente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PacienteTest extends TestCase
{
    use RefreshDatabase;

    public function test_pode_cadastrar_paciente(): void
    {
        $response = $this->post(route('pacientes.store'), [
            'nome'     => 'João Silva',
            'telefone' => '(11) 99999-0000',
            'email'    => 'joao@example.com',
        ]);

        $response->assertRedirect(route('pacientes.index'));
        $this->assertDatabaseHas('pacientes', ['email' => 'joao@example.com']);
    }

    public function test_email_duplicado_falha(): void
    {
        Paciente::create(['nome' => 'A', 'telefone' => '1', 'email' => 'dup@test.com']);

        $response = $this->post(route('pacientes.store'), [
            'nome'     => 'B',
            'telefone' => '2',
            'email'    => 'dup@test.com',
        ]);

        $response->assertSessionHasErrors('email');
    }
}
