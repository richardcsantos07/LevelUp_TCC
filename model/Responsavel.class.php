<?php

class Responsavel
{

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $telefone;
    private $data_nasc;
    private $cpf;
    private $nivelAcesso;
    private $pdo;
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
    public function getDataNasc()
    {
        return $this->data_nasc;
    }

    public function setDataNasc($data_nasc)
    {
        $this->data_nasc = $data_nasc;
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

    public function getCpf()
    {
        return $this->cpf;
    }
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    function __construct()
    {
        $dns = "mysql:host=localhost;dbname=leveluptest";
        $dbUser = "root";
        $dbPass = "";

        try {
            $this->pdo = new PDO($dns, $dbUser, $dbPass);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function criarCadastroResp($nome, $email, $senha, $data_nasc, $telefone, $cpf)
    {
        $sql = "INSERT INTO responsavel SET nome = :n, email = :e, senha = :s, dataNasc = :d, telefone = :t, cpf = :c";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':n', $nome);
        $stmt->bindValue(':e', $email);
        $stmt->bindValue(':s', $senha);
        $stmt->bindValue(':d', $data_nasc);
        $stmt->bindValue(':t', $telefone);
        $stmt->bindValue(':c', $cpf);

        return $stmt->execute();
    }

    public function chkUser($email)
    {
        $sql = "SELECT * FROM responsavel WHERE email = :e";
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
        $sql = "SELECT * FROM responsavel WHERE email = :e AND senha = :s";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':e', $email);
        $stmt->bindValue(':s', $senha);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return array();
        }

    }

    public function conferirCadastro($id)
    {
        $sql = "SELECT * FROM responsavel WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    public function deletarCadResp($id)
    {

        try {
            // Inicia a transação
            $this->pdo->beginTransaction();

            // Primeiro deleta as crianças
            $deleteCri = "DELETE FROM crianca WHERE idResponsavel = :id";
            $stmtC = $this->pdo->prepare($deleteCri);
            $stmtC->bindValue(':id', $id);
            $stmtC->execute();

            // Depois deleta o responsável
            $deleteResp = "DELETE FROM responsavel WHERE id = :id";
            $stmt = $this->pdo->prepare($deleteResp);
            $stmt->bindValue(':id', $id);
            $result = $stmt->execute();

            // Se tudo deu certo, confirma as alterações
            $this->pdo->commit();

            return $result;

        } catch (PDOException $e) {
            // Em caso de erro, desfaz as alterações
            $this->pdo->rollBack();
            throw new Exception("Erro ao deletar cadastro: " . $e->getMessage());
        }
    }

     public function updateCadResp($nome, $email, $senha, $data_nasc, $telefone, $cpf, $id)
    {
        $sql = "UPDATE responsavel SET nome = :n, email = :e, senha = :s, dataNasc = :d, telefone = :t, cpf = :c WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':n', $nome);
        $stmt->bindValue(':e', $email);
        $stmt->bindValue(':s', $senha);
        $stmt->bindValue(':d', $data_nasc);
        $stmt->bindValue(':t', $telefone);
        $stmt->bindValue(':c', $cpf);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    public function alterarConfig()
    {

    }

    public function criarAtividade()
    {

    }

    public function atribuirNota()
    {

    }




}