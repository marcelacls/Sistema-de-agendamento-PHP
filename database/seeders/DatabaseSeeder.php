<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paciente;
use App\Models\Dentista;
use App\Models\Consulta;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Pacientes
        $pacientes = [
            ['nome' => 'Marcela Cabral',     'telefone' => '(11) 97888-1111', 'email' => 'marcela@email.com'],
            ['nome' => 'Vinicius Federi',    'telefone' => '(11) 97787-2222', 'email' => 'vinicius@email.com'],
            ['nome' => 'Ana Ferreira', 'telefone' => '(11) 96666-3233', 'email' => 'ana@email.com'],
            ['nome' => 'Carlos Eduardo',     'telefone' => '(11) 95355-4444', 'email' => 'carlos@email.com'],
            ['nome' => 'Fernanda Oliveira',  'telefone' => '(11) 94448-5555', 'email' => 'fernanda@email.com'],
        ];

        foreach ($pacientes as $p) {
            Paciente::create($p);
        }

        // Dentistas
        $dentistas = [
            ['nome' => 'Dr. Rafael Rocha',   'especialidade' => 'Ortodontia'],
            ['nome' => 'Dr. Pedro Oliveira',  'especialidade' => 'Clínico Geral'],
            ['nome' => 'Dr. Alan Souza',     'especialidade' => 'Implantodontia'],
            ['nome' => 'Dra. Marcela Santos', 'especialidade' => 'Odontopediatria'],
        ];

        foreach ($dentistas as $d) {
            Dentista::create($d);
        }

        // Consultas
        $consultas = [
            ['paciente_id' => 1, 'dentista_id' => 1, 'data' => '2025-05-20', 'hora' => '09:00', 'status' => 'confirmada'],
            ['paciente_id' => 2, 'dentista_id' => 2, 'data' => '2025-05-21', 'hora' => '14:30', 'status' => 'pendente'],
            ['paciente_id' => 3, 'dentista_id' => 3, 'data' => '2025-05-22', 'hora' => '11:00', 'status' => 'cancelada'],
            ['paciente_id' => 4, 'dentista_id' => 4, 'data' => '2025-05-23', 'hora' => '10:00', 'status' => 'pendente'],
            ['paciente_id' => 5, 'dentista_id' => 1, 'data' => '2025-05-24', 'hora' => '15:00', 'status' => 'confirmada'],
        ];

        foreach ($consultas as $c) {
            Consulta::create($c);
        }
    }
}
