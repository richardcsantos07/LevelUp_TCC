<?php

class Crianca
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $idResponsavel;
    private $dataNasc;
    private $nivelAcesso;
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
    public function getIdResponsavel()
    {
        return $this->idResponsavel;
    }
    public function setIdResponsavel($idResponsavel)
    {
        $this->idResponsavel = $idResponsavel;
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

    public function __construct(Instituicao $instituicao)
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

    public function inserirCadCri($nome, $email, $senha, $idResponsavel, $dataNasc)
    {
        $sql = "INSERT INTO crianca (nome, email, idResponsavel, dataNasc) VALUES (:n, :e, :s, :idr :d)";
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindValue(':n', $nome);
        $stmt->bindValue(':e', $email);
        $stmt->bindValue(':s', $senha);
        $stmt->bindValue(':idr', $idResponsavel);
        $stmt->bindValue(':d', $dataNasc);
        return $stmt->execute();
    }

    public function conferirCadCri()
    {
       
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
