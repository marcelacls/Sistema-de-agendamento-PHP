<?php

require_once 'Paciente.php';
require_once 'Dentista.php';

class Consulta {
    private int $id;
    private Paciente $paciente;
    private Dentista $dentista;
    private string $data;
    private string $hora;
    private string $status;

    public function __construct(
        int $id,
        Paciente $paciente,
        Dentista $dentista,
        string $data,
        string $hora
    ) {
        $this->id = $id;
        $this->paciente = $paciente;
        $this->dentista = $dentista;
        $this->data = $data;
        $this->hora = $hora;
        $this->status = "agendado";
    }

    public function getId(): int {
        return $this->id;
    }

    public function getPaciente(): Paciente {
        return $this->paciente;
    }

    public function getDentista(): Dentista {
        return $this->dentista;
    }

    public function getData(): string {
        return $this->data;
    }

    public function getHora(): string {
        return $this->hora;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function cancelar(): void {
        $this->status = "cancelado";
    }

    public function validarHorario(array $consultas): void {
        foreach ($consultas as $c) {
            if (
                $c->getData() === $this->data &&
                $c->getHora() === $this->hora
            ) {
                throw new Exception("Horário já ocupado");
            }
        }
    }
}
?>