<?php

class Paciente {
    private int $id;
    private string $nome;
    private string $telefone;
    private string $email;

    public function __construct(int $id, string $nome, string $telefone, string $email) {
        $this->id = $id;
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->email = $email;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getTelefone(): string {
        return $this->telefone;
    }

    public function getEmail(): string {
        return $this->email;
    }
}
?>



