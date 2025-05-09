<?php

class Professor
{

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $materia;
    private $data_nasc;
    private $cpf;
    private $nivelAcesso;
    private $telefone;
    private $id_inst;
    private $pdo;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getIdInst(){
        return $this->id_inst;
    }
    public function setIdInst($id_inst){
        $this->id_inst = $id_inst;
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

    public function getPdo()
    {
        return $this->pdo;
    }

    public function getCpf()
    {
        return $this->cpf;
    }
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }


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

    public function criarCadastroProf($nome, $email, $senha, $materia, $cpf, $data_nasc, $telefone, $id_inst)
    {
        $sql = "INSERT INTO professor SET nome = :n, email = :e, senha = :s, materia = :m, cpf = :c, dataNasc = :d, telefone = :t, id_inst = :ii";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':n', $nome);
        $stmt->bindValue(':e', $email);
        $stmt->bindValue(':s', $senha);
        $stmt->bindValue(':m', $materia);
        $stmt->bindValue(':c', $cpf);
        $stmt->bindValue(':d', $data_nasc);
        $stmt->bindValue(':t', $telefone);
        $stmt->bindValue(':ii', $id_inst);

        return $stmt->execute();
    }

    public function chkUser($email)
    {
        $sql = "SELECT * FROM professor WHERE email = :e";
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
        $sql = "SELECT * FROM professor WHERE email = :e AND senha = :s";
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

    public function listarTodosProfessores($id_inst)
    {
        $sql = "SELECT * FROM professor WHERE id_inst = :ii ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':ii', $id_inst);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array(); // Retorna array vazio em vez de null para facilitar o loop
        }
    }
        
    



    public function conferirCadastro()
    {

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