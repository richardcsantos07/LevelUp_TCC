<?php

class Crianca
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $idResponsavel;
    private $nomeResponsavel;
    private $dataNasc;
    private $nivelAcesso;
    private $instituicao; // atributo para composição

    public function __construct(Instituicao $instituicao)
    {
        $this->instituicao = $instituicao;
    }

    // getters e setters para os atributos

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getSenha()
    {
        return $this->senha;
    }
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getIdResponsavel()
    {
        return $this->idResponsavel;
    }
    public function setIdResponsavel($idResponsavel)
    {
        $this->idResponsavel = $idResponsavel;
    }
    public function getNomeResponsavel()
    {
        return $this->nomeResponsavel;
    }
    public function setNomeResponsavel($nomeResponsavel)
    {
        $this->nomeResponsavel = $nomeResponsavel;
    }
    public function getDataNasc()
    {
        return $this->dataNasc;
    }
    public function setDataNasc($dataNasc)
    {
        $this->dataNasc = $dataNasc;
    }
    public function getNivelAcesso()
    {
        return $this->nivelAcesso;
    }
    public function setNivelAcesso($nivelAcesso)
    {
        $this->nivelAcesso = $nivelAcesso;
    }

    // métodos específicos da Crianca

    public function conferirCadCri()
    {
        return $this->instituicao->conferirCadInstituicao();
    }

    public function verJogos()
    {
        // implementação
    }

    public function jogar()
    {
        // implementação
    }

    public function conferirProgresso()
    {
        // implementação
    }

    public function alterarConfig()
    {
        // implementação
    }

    public function verAtvSugeridas()
    {
        // implementação
    }
}
