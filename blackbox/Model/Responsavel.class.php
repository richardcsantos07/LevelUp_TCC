<?php

require_once __DIR__ . '/Instituicao.class.php';

class Responsavel
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $nomeCrianca; // array ou string conforme necessidade
    private $idCrianca;   // array ou string conforme necessidade
    private $dataNasc;
    private $nivelAcesso;
    private $telefone;
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
    public function getNomeCrianca()
    {
        return $this->nomeCrianca;
    }
    public function setNomeCrianca($nomeCrianca)
    {
        $this->nomeCrianca = $nomeCrianca;
    }
    public function getIdCrianca()
    {
        return $this->idCrianca;
    }
    public function setIdCrianca($idCrianca)
    {
        $this->idCrianca = $idCrianca;
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
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    // métodos específicos do Responsavel

    public function inserirCadResp()
    {
        // implementação
    }

    public function alterarCadResp()
    {
        // implementação
    }

    public function inserirCadCri()
    {
        // implementação
    }

    public function alterarCadCri()
    {
        // implementação
    }

    public function conferirCadResp()
    {
        return $this->instituicao->conferirCadInstituicao();
    }

    public function conferirCadCri()
    {
        return $this->instituicao->conferirCadInstituicao();
    }

    public function deletarCadCri()
    {
        // implementação
    }

    public function verJogos()
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

    public function sugerirAtv()
    {
        // implementação
    }

    public function restingirCateg()
    {
        // implementação
    }
}
