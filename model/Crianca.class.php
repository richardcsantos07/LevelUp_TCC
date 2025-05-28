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
    private $telefone;
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
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
    public function getPdo()
    {
        return $this->pdo;
    }

    public function __construct()
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
        $sql = "SELECT * FROM crianca WHERE email = :e";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':e', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $info = $stmt->fetch(PDO::FETCH_ASSOC);
            return $info;
        } else {
            $info = array();
            return $info;
        }

    }

    public function inserirCadCri($nome, $email, $senha, $idResponsavel, $dataNasc, $telefone)
    {
        $sql = "INSERT INTO crianca (nome, email, senha, idResponsavel, dataNasc, telefone) VALUES (:n, :e, :s, :idr, :d, :t)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':n', $nome);
        $stmt->bindValue(':e', $email);
        $stmt->bindValue(':s', $senha);
        $stmt->bindValue(':idr', $idResponsavel);
        $stmt->bindValue(':d', $dataNasc);
        $stmt->bindValue(':t', $telefone);
        return $stmt->execute();
    }

    public function conferirCadCri($idResponsavel)
    {
        $sql = "SELECT * FROM crianca WHERE idResponsavel = :idr";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idr', $idResponsavel);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

    public function deletarCadCri($id)
    {

        try {
            $sql = "DELETE FROM crianca WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao deletar criança: " . $e->getMessage();
            return false;
        }
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
