<?php

namespace Tests\Unit;

use App\Models\Consulta;
use PHPUnit\Framework\TestCase;

class ConsultaTest extends TestCase
{
    public function test_consulta_tem_fillable_corretos(): void
    {
        $consulta = new Consulta();
        $this->assertEquals(
            ['paciente_id', 'dentista_id', 'data', 'hora'],
            $consulta->getFillable()
        );
    }
}
