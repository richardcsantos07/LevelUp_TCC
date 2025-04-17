<?php

class Aluno {
    private $ra;
    private $nome;
    private $email;
    private $senha;
    private $turma;
    private $serie;
    private $dataNasc;
    private $nivelAcesso;
    private $nomelnstituicao;

    public function __construct($ra, $nome, $email, $senha, $turma, $serie, $dataNasc, $nivelAcesso, $nomelnstituicao) {
        $this->ra = $ra;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->turma = $turma;
        $this->serie = $serie;
        $this->dataNasc = $dataNasc;
        $this->nivelAcesso = $nivelAcesso;
        $this->nomelnstituicao = $nomelnstituicao;
    }

    public function conferirCadAluno() {
        // Implementação do método
    }

    public function verJogos() {
        // Implementação do método
    }

    public function jogar() {
        // Implementação do método
    }

    public function conferirProgresso() {
        // Implementação do método
    }

    public function alterarConfig() {
        // Implementação do método
    }

    public function verAtvSugeridas() {
        // Implementação do método
    }
}
?>
