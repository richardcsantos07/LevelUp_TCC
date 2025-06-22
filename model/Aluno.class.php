<?php

class Aluno
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $turma;
    private $nomeResponsavel;
    private $telefoneResponsavel;
    private $telefone;
    private $dataNasc;
    private $nivelAcesso;
    private $id_inst;
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
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
    public function getNomeResponsavel()
    {
        return $this->nomeResponsavel;
    }
    public function setNomeResponsavel($nomeResponsavel)
    {
        $this->nomeResponsavel = $nomeResponsavel;
    }
    public function getTelefoneResponsavel()
    {
        return $this->telefoneResponsavel;
    }
    public function setTelefoneResponsavel($telefoneResponsavel)
    {
        $this->telefoneResponsavel = $telefoneResponsavel;
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

    public function getIdInst()
    {
        return $this->id_inst;
    }

    public function setIdInst($id_inst)
    {
        $this->id_inst = $id_inst;
    }

    // Método para retornar a conexão PDO
    public function getPdo()
    {
        return $this->pdo;
    }

    // métodos específicos do Aluno

    function __construct()
    {
        $dns = "mysql:dbname=leveluptest;host=localhost";
        $dbUser = "root";
        $dbPass = "";

        try {
            $this->pdo = new PDO($dns, $dbUser, $dbPass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch (\Throwable $th) {
            echo "Erro de conexão: " . $th->getMessage();
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
            $info = $stmt->fetch(PDO::FETCH_ASSOC);
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
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

    public function inserirCadAluno($id, $nome, $email, $senha, $telefone, $turma, $dataNasc, $nomeResponsavel, $telefoneResponsavel, $id_inst)
    {
        $sql = "INSERT INTO aluno (ra, nome, email, senha, tell, turma, dataNasc, nome_responsavel, tell_responsavel, id_inst) VALUES (:ra, :n, :e, :s, :t, :tur, :d, :nr, :tr, :ii)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':ra', $id);
        $stmt->bindValue(':n', $nome);
        $stmt->bindValue(':e', $email);
        $stmt->bindValue(':s', $senha);
        $stmt->bindValue(':t', $telefone);
        $stmt->bindValue(':tur', $turma);
        $stmt->bindValue(':d', $dataNasc);
        $stmt->bindValue(':nr', $nomeResponsavel);
        $stmt->bindValue(':tr', $telefoneResponsavel);
        $stmt->bindValue(':ii', $id_inst);
        return $stmt->execute();
    }

    public function updateCadAluno($id, $nome, $email, $senha, $telefone, $turma, $dataNasc, $nomeResponsavel, $telefoneResponsavel, $id_inst)
    {
        $sql = "UPDATE aluno SET nome = :n, email = :e, senha = :s, tell = :t, turma = :tur, dataNasc = :d, nome_responsavel = :nr, tell_responsavel = :tr WHERE ra = :ra AND id_inst = :ii";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':ra', $id);
        $stmt->bindValue(':n', $nome);
        $stmt->bindValue(':e', $email);
        $stmt->bindValue(':s', $senha);
        $stmt->bindValue(':t', $telefone);
        $stmt->bindValue(':tur', $turma);
        $stmt->bindValue(':d', $dataNasc);
        $stmt->bindValue(':nr', $nomeResponsavel);
        $stmt->bindValue(':tr', $telefoneResponsavel);
        $stmt->bindValue(':ii', $id_inst);
        return $stmt->execute();
    }

    public function conferirCadAlunoForId($id, $id_inst)
    {
        $sql = "SELECT * FROM aluno WHERE ra = :id AND id_inst = :ii";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':ii', $id_inst);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    public function conferirCadAluno()
    {
        $sql = "SELECT * FROM aluno ORDER BY ra DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    // Novo método para listar todos os alunos
    public function listarTodosAlunos($id_inst)
    {
        $sql = "SELECT * FROM aluno WHERE id_inst = :ii ORDER BY ra DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':ii', $id_inst);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array(); 
        }
    }

    public function excluirAluno($id, $id_inst)
    {

         try {
        $sql = "DELETE FROM aluno WHERE ra = :ra AND id_inst = :id_inst";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':ra', $id);
        $stmt->bindValue(':id_inst', $id_inst);
        return $stmt->execute();
    } catch(PDOException $e) {
        echo "Erro ao excluir: " . $e->getMessage();
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