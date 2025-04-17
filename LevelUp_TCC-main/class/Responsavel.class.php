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
        
    }

    public function alterarCadResp() {
        
    }

    public function inserirCadCri() {
        
    }

    public function alterarCadCri() {
        
    }

    public function conferirCadResp() {
    
    }

    public function conferirCadCri() {
        
    }

    public function deletarCadCri() {
        
    }

    public function verJogos() {
        
    }

    public function conferirProgresso() {
    
    }

    public function alterarConfig() {
        
    }

    public function sugerirAtv() {
    
    }

    public function restringirCateg() {
        
}
}
?>