<?php

class Task
{
    private $id;
    private $nome;
    private $descricao;
    private $materia;
    private $nota;
    private $id_atv;
    private $id_aluno;
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
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function getMateria()
    {
        return $this->materia;
    }
    public function setMateria($materia)
    {
        $this->materia = $materia;
    }
    public function getNota()
    {
        return $this->nota;
    }
    public function setNota($nota)
    {
        $this->nota = $nota;
    }
    public function getId_atv()
    {
        return $this->id_atv;
    }
    public function setId_atv($id_atv)
    {
        $this->id_atv = $id_atv;
    }
    public function getId_aluno()
    {
        return $this->id_aluno;
    }
    public function setId_aluno($id_aluno)
    {
        $this->id_aluno = $id_aluno;
    }
    public function getPDO()
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

    public function criarAtv($nome, $materia, $descricao, $nota)
    {
        $sql = "INSERT INTO atividade (nome, materia, descricao, nota) VALUES
        (:n, :m, :d, :nt)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':n', $nome);
        $stmt->bindValue(':m', $materia);
        $stmt->bindValue(':d', $descricao);
        $stmt->bindValue(':nt', $nota);

        return $stmt->execute();
    }

    public function conferirAtv()
    {
        $sql = "SELECT * FROM atividade ORDER BY id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

    public function deletarAtv($id)
    {
        $sql = "DELETE FROM atividade WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function atualizarAtv($id, $nome, $materia, $descricao, $nota){
        $sql = "UPDATE atividade SET nome = :n, materia = :m, descricao = :d, nota = :nt WHERE id = :id";
        $stmt = $this-> pdo-> prepare($sql);
        $stmt-> bindValue(':n', $nome);
        $stmt-> bindValue(':m', $materia);
        $stmt-> bindValue(':d', $descricao);
        $stmt-> bindValue(':nt', $nota);
        $stmt-> bindValue(':id', $id);

        return $stmt->execute();
    }

}