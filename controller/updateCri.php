<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: ../view/login.php");
    exit;
}

require '../model/Crianca.class.php';

$criancaObj = new Crianca();

if (!$criancaObj) {
    echo "<h1>Erro ao conectar ao Banco de Dados!</h1>";
    exit;
}

if (isset($_POST['btn-save-profile'])) {
    try {
        // Capturar dados do formulário
        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $id = (int)$_POST['id'];
        $data_nasc = $_POST['data_nasc'];
        $telefone = trim($_POST['telefone']);
        $id_resp = $_SESSION['id'];
        
        // Validações básicas
        if (empty($nome) || empty($email) || empty($id) || empty($data_nasc) || empty($telefone)) {
            throw new Exception("Todos os campos obrigatórios devem ser preenchidos");
        }
        
        // Verificar se a criança pertence ao responsável logado
        $criancaExistente = $criancaObj->buscarCriancaPorId($id, $id_resp);
        if (!$criancaExistente) {
            throw new Exception("Criança não encontrada ou não pertence a este responsável");
        }
        
        // Verificar se uma nova senha foi fornecida
        $senha = '';
        if (!empty($_POST['senha'])) {
            $senha = trim($_POST['senha']);
        }

        // Chamar método de atualização
        $resultado = $criancaObj->updateCadCri(
            $nome,
            $email,
            $senha,
            $id_resp,
            $data_nasc,
            $telefone,
            $id
        );
        
        if ($resultado) {
            // Redirecionamento com mensagem de sucesso
            header("Location: ../view/MenuResponsavel.php?msg=success&type=update");
            exit;
        } else {
            // Redirecionamento com mensagem de erro
            header("Location: ../view/MenuResponsavel.php?msg=error&type=update");
            exit;
        }
        
    } catch (Exception $e) {
        // Log do erro (opcional)
        error_log("Erro ao atualizar crianca: " . $e->getMessage());
        
        // Redirecionamento com mensagem de erro
        header("Location: ../view/MenuResponsavel.php?msg=error&type=update&error=" . urlencode($e->getMessage()));
        exit;
    }
} else {
    // Se não foi enviado via POST, redirecionar
    header("Location: ../view/MenuResponsavel.php");
    exit;
}
?>