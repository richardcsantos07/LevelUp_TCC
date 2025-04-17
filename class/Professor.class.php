<?php

class Professor
{

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $materia;
    private $data_nascimento;
    private $nivelAcesso;
    private $telefone;
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
    public function getMateria()
    {
        return $this->materia;
    }
    public function setMateria($materia)
    {
        $this->materia = $materia;
    }

    function __construct()
    {
        $dns = "mysql:dbname=level_up;host=localhost";
        $dbUser = "root";
        $dbPass = "";

        try {
            $this->pdo = new PDO($dns, $dbUser, $dbPass);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function conferirCadastro(){

    }

    public function alterarConfig(){

    }

    public function criarAtividade(){

    }

    public function atribuirNota(){

    }
    




}