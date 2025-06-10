<?php

class Jogo {
    private $id;
    private $nome;
    private $categoria;
    private $progress;
    private $pdo;

    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getCategoria() {
        return $this->categoria;
    }
    
    public function setCategoria($categoria) {
        $this->categoria = $categoria;
    }
    
    public function getProgress() {
        return $this->progress;
    }
    
    public function setProgress($progress) {
        $this->progress = $progress;
    }
    
    public function getPDO() {
        return $this->pdo;
    }

    function __construct() {
        $dns = "mysql:dbname=leveluptest;host=localhost";
        $dbUser = "root";
        $dbPass = "";

        try {
            $this->pdo = new PDO($dns, $dbUser, $dbPass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return true;
        } catch (PDOException $e) {
            error_log("Erro de conexão com banco: " . $e->getMessage());
            return false;
        }
    }
    
    // Método para verificar se a conexão foi bem-sucedida
    public function isConnected() {
        return $this->pdo !== null;
    }
}

?>