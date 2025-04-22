<?php

class Aluno
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $turma;
    private $serie;
    private $dataNasc;
    private $nivelAcesso;
    private $instituicao;
    private $pdo;


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
    public function getTurma()
    {
        return $this->turma;
    }
    public function setTurma($turma)
    {
        $this->turma = $turma;
    }
    public function getSerie()
    {
        return $this->serie;
    }
    public function setSerie($serie)
    {
        $this->serie = $serie;
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

    public function getInst()
    {
        return $this->instituicao;
    }

    public function setInst($instituicao)
    {
        $this->instituicao = $instituicao;
    }

    // métodos específicos do Aluno

    function __construct()
    {
        $dns = "mysql:dbname=leveluptest;host=localhost";
        $dbUser = "root";
        $dbPass = "";

        try {
            $this->pdo = new PDO($dns, $dbUser, $dbPass);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function chkUser($email)
    {
        $sql = "SELECT * FROM aluno WHERE email = :e";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':e', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $info = $stmt->fetch();
            return $info;
        } else {
            $info = array();
            return $info;
        }

    }

    public function chkUserPass($email, $senha)
    {
        $sql = "SELECT * FROM aluno WHERE email = :e AND senha = :s";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':e', $email);
        $stmt->bindValue(':s', $senha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch();
        } else {
            return array();
        }

    }

    public function inserirCadAluno($nome, $email, $senha, $serie, $turma, $dataNasc, $instituicao)
    {
        $sql = "INSERT INTO aluno (nome, email, senha, serie, turma, data_nasc, instituicao) VALUES (:n, :e, :s, :ser, :tur, :d, :i)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':n', $nome);
        $stmt->bindValue(':e', $email);
        $stmt->bindValue(':s', $senha);
        $stmt->bindValue(':ser', $serie);
        $stmt->bindValue(':tur', $turma);
        $stmt->bindValue(':d', $dataNasc);
        $stmt->bindValue(':i', $instituicao);
        return $stmt->execute();

    }

    public function conferirCadAluno()
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
