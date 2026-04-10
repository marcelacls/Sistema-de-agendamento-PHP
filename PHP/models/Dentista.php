<?php

class Dentista {
    private int $id;
    private string $nome;
    private string $especialidade;

    public function __construct(int $id, string $nome, string $especialidade) {
        $this->id = $id;
        $this->nome = $nome;
        $this->especialidade = $especialidade;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getEspecialidade(): string {
        return $this->especialidade;
    }
}
?>