<?php
session_start();

require '../model/Responsavel.class.php';

$respObj = new Responsavel();

if (!$respObj) {
    echo "<h1>Erro ao conectar ao Banco de Dados!</h1>";
    exit;
}

if (isset($_POST['btn-save-profile'])) {
    try {
        // Capturar dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $data_nasc = $_POST['data_nasc'];
        $telefone = $_POST['telefone'];
        $id = $_SESSION['id'];
        
        // Verificar se uma nova senha foi fornecida
        $senha = '';
        if (!empty($_POST['senha'])) {
            $senha = $_POST['senha'];
        }

        // Chamar método de atualização
        $resultado = $respObj->updateCadResp($nome, $email, $senha, $data_nasc, $telefone, $cpf, $id);
        
        if ($resultado) {
            // Redirecionamento com mensagem de sucesso
            header("Location: ../view/MenuResponsavel.php?msg=success");
            exit;
        } else {
            // Redirecionamento com mensagem de erro
            header("Location: ../view/MenuResponsavel.php?msg=error");
            exit;
        }
        
    } catch (Exception $e) {
        // Log do erro (opcional)
        error_log("Erro ao atualizar responsável: " . $e->getMessage());
        
        // Redirecionamento com mensagem de erro
        header("Location: ../view/MenuResponsavel.php?msg=error");
        exit;
    }
} else {
    // Se não foi enviado via POST, redirecionar
    header("Location: ../view/MenuResponsavel.php");
    exit;
}
?>