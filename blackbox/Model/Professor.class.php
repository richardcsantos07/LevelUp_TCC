<?php

require_once __DIR__ . '/Instituicao.class.php';

class Professor
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $materia;
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
    public function getMateria()
    {
        return $this->materia;
    }
    public function setMateria($materia)
    {
        $this->materia = $materia;
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

    // métodos específicos do Professor

    public function conferirCadProf()
    {
        return $this->instituicao->conferirCadInstituicao();
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

    public function sugerirAtv()
    {
        // implementação
    }

    public function verTurmas()
    {
        // implementação
    }

    public function inserirNota()
    {
        // implementação
    }
}
