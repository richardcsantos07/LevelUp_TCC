<?php

class Responsavel {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $nomeCrianca;
    private $idCrianca;
    private $dataNasc;
    private $nivelAcesso;
    private $telefone;

    public function __construct($id, $nome, $email, $senha, $nomeCrianca, $idCrianca, $dataNasc, $nivelAcesso, $telefone) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->nomeCrianca = $nomeCrianca;
        $this->idCrianca = $idCrianca;
        $this->dataNasc = $dataNasc;
        $this->nivelAcesso = $nivelAcesso;
        $this->telefone = $telefone;
    }

    public function inserirCadResp() {
        // Implementação do método
    }

    public function alterarCadResp() {
        // Implementação do método
    }

    public function inserirCadCri() {
        // Implementação do método
    }

    public function alterarCadCri() {
        // Implementação do método
    }

    public function conferirCadResp() {
        // Implementação do método
    }

    public function conferirCadCri() {
        // Implementação do método
    }

    public function deletarCadCri() {
        // Implementação do método
    }

    public function verJogos() {
        // Implementação do método
    }

    public function conferirProgresso() {
        // Implementação do método
    }

    public function alterarConfig() {
        // Implementação do método
    }

    public function sugerirAtv() {
        // Implementação do método
    }

    public function restringirCateg() {
        // Implementação do método
    }
}
?>
