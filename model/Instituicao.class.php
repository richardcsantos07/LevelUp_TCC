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
    public function getPdo()
    {
        return $this->pdo;
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

    public function chkUser($email)
    {
        $sql = "SELECT * FROM instituicao WHERE email = :e";
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
        $sql = "SELECT * FROM instituicao WHERE email = :e AND senha = :s";
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

    public function inserirCadInstituicao($nome, $email, $senha, $telefone, $cep, $estado, $bairro, $rua, $num, $cnpj, $tipoInstituicao, $dataCriacaoInst)
    {
        $sql = "INSERT INTO instituicao (nome, email, senha, telefone, cep, estado, bairro, rua, num, cnpj, tipoInstituicao, dataCriacaoInst) VALUES (:n, :e, :s, :t, :c, :es, :b, :r, :num, :cnpj, :ti, :dc)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':n', $nome);
        $stmt->bindValue(':e', $email);
        $stmt->bindValue(':t', $telefone);
        $stmt->bindValue(':s', $senha);
        $stmt->bindValue(':c', $cep);
        $stmt->bindValue(':es', $estado);
        $stmt->bindValue(':b', $bairro);
        $stmt->bindValue(':r', $rua);
        $stmt->bindValue(':num', $num);
        $stmt->bindValue(':cnpj', $cnpj);
        $stmt->bindValue(':ti', $tipoInstituicao);
        $stmt->bindValue(':dc', $dataCriacaoInst);
        return $stmt->execute();

    }

    public function inserirCadComunicado($titulo, $destinatario, $descricao, $data_comunicado, $arquivo, $idInstituicao)
    {
        $sql = "INSERT INTO comunicado (titulo, destinatario, descricao, data_comunicado, arquivo_upado, id_inst) VALUES (:t, :d, :dc, :dt, :a, :id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':t', $titulo);
        $stmt->bindValue(':d', $destinatario);
        $stmt->bindValue(':dc', $descricao);
        $stmt->bindValue(':dt', $data_comunicado);
        $stmt->bindValue(':a', $arquivo);
        $stmt->bindValue(':id', $idInstituicao);
        return $stmt->execute();
    }

     public function conferirCadComunicado($id_inst)
    {
        $sql = "SELECT * FROM comunicado WHERE id_inst = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id_inst);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

    public function excluirComunicado($id, $id_inst)
    {

        try {
            $sql = "DELETE FROM comunicado WHERE id = :id AND id_inst = :id_inst";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':id_inst', $id_inst);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir: " . $e->getMessage();
            return false;
        }

    }

    public function conferirCadInstituicao($id)
    {
        $sql = "SELECT * FROM instituicao WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return array();
        }
    }

    public function deletarCadInstituicao()
    {
        // implementação
    }

    public function alterarCadInstituicao($id, $nome, $email, $senha, $telefone, $cep, $estado, $bairro, $rua, $num)
    {
        $sql = "UPDATE instituicao SET nome = :nome, email = :email, senha = :senha, telefone = :telefone, cep = :cep, estado = :estado, bairro = :bairro, rua = :rua, num = :num WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->bindValue(':telefone', $telefone);
        $stmt->bindValue(':cep', $cep);
        $stmt->bindValue(':estado', $estado);
        $stmt->bindValue(':bairro', $bairro);
        $stmt->bindValue(':rua', $rua);
        $stmt->bindValue(':num', $num);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
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
