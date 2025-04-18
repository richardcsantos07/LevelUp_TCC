<?php

class Instituicao
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $nivelAcesso;
    private $cnpj;
    private $tipoInstituicao;
    private $dataCriacaoInst;
    private $estado;
    private $bairro;
    private $rua;
    private $num;
    private $cep;
    private $telefone;

    public function __construct()
    {
        // inicialização, se necessário
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
    public function getNivelAcesso()
    {
        return $this->nivelAcesso;
    }
    public function setNivelAcesso($nivelAcesso)
    {
        $this->nivelAcesso = $nivelAcesso;
    }
    public function getCnpj()
    {
        return $this->cnpj;
    }
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }
    public function getTipoInstituicao()
    {
        return $this->tipoInstituicao;
    }
    public function setTipoInstituicao($tipoInstituicao)
    {
        $this->tipoInstituicao = $tipoInstituicao;
    }
    public function getDataCriacaoInst()
    {
        return $this->dataCriacaoInst;
    }
    public function setDataCriacaoInst($dataCriacaoInst)
    {
        $this->dataCriacaoInst = $dataCriacaoInst;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    public function getBairro()
    {
        return $this->bairro;
    }
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }
    public function getRua()
    {
        return $this->rua;
    }
    public function setRua($rua)
    {
        $this->rua = $rua;
    }
    public function getNum()
    {
        return $this->num;
    }
    public function setNum($num)
    {
        $this->num = $num;
    }
    public function getCep()
    {
        return $this->cep;
    }
    public function setCep($cep)
    {
        $this->cep = $cep;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    // métodos de cadastro e alteração

    public function inserirCadInstituicao()
    {
        // implementação
    }

    public function conferirCadInstituicao()
    {
        // implementação
    }

    public function deletarCadInstituicao()
    {
        // implementação
    }

    public function alterarCadInstituicao()
    {
        // implementação
    }

    public function inserirCadAluno()
    {
        // implementação
    }

    public function conferirCadAluno()
    {
        // implementação
    }

    public function deletarCadAluno()
    {
        // implementação
    }

    public function alterarCadAluno()
    {
        // implementação
    }

    public function inserirCadProf()
    {
        // implementação
    }

    public function conferirCadProf()
    {
        // implementação
    }

    public function deletarCadProf()
    {
        // implementação
    }

    public function alterarCadProf()
    {
        // implementação
    }

    public function verJogos()
    {
        // implementação
    }

    public function conferirProgressoTurma()
    {
        // implementação
    }

    public function conferirProgressoAluno()
    {
        // implementação
    }

    public function alterarConfig()
    {
        // implementação
    }

    public function criarTurma()
    {
        // implementação
    }

    public function alterarTurma()
    {
        // implementação
    }

    public function deletarTurma()
    {
        // implementação
    }

    public function verTurmas()
    {
        // implementação
    }

    public function inserirAlunoTurma()
    {
        // implementação
    }

    public function restingirCateg()
    {
        // implementação
    }
}
