<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: ../view/login.php");
    exit;
}

require '../model/Aluno.class.php';

$alunoObj = new Aluno();

if (!$alunoObj) {
    echo "<h1>Erro ao conectar ao Banco de Dados!</h1>";
    exit;
}

// DEPURAÇÃO: Log dos dados recebidos
error_log("=== INÍCIO ATUALIZAÇÃO ALUNO ===");
error_log("POST recebido: " . print_r($_POST, true));
error_log("SESSION ID: " . $_SESSION['id']);

// CORREÇÃO 1: Verificar se há dados POST (não apenas o botão)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    try {
        // CORREÇÃO 2: Usar os nomes corretos dos campos do formulário
        $ra = isset($_POST['ra-aluno']) ? (int) $_POST['ra-aluno'] : 0;
        $nome = isset($_POST['nome-aluno']) ? trim($_POST['nome-aluno']) : '';
        $email = isset($_POST['email-aluno']) ? trim($_POST['email-aluno']) : '';
        $data_nasc = isset($_POST['data-nascimento']) ? $_POST['data-nascimento'] : '';
        $telefone = isset($_POST['telefone-aluno']) ? trim($_POST['telefone-aluno']) : '';
        $id_inst = $_SESSION['id'];
        $turma = isset($_POST['turma-aluno']) ? trim($_POST['turma-aluno']) : '';
        $nomeResponsavel = isset($_POST['responsavel-aluno']) ? trim($_POST['responsavel-aluno']) : '';
        $telefoneResponsavel = isset($_POST['telefone-responsavel']) ? trim($_POST['telefone-responsavel']) : '';

        // DEPURAÇÃO: Log dos dados processados
        error_log("Dados processados para atualização:");
        error_log("RA: " . $ra);
        error_log("Nome: " . $nome);
        error_log("Email: " . $email);
        error_log("Data Nasc: " . $data_nasc);
        error_log("Telefone: " . $telefone);
        error_log("Turma: " . $turma);
        error_log("Nome Responsável: " . $nomeResponsavel);
        error_log("Tel Responsável: " . $telefoneResponsavel);
        error_log("ID Instituição: " . $id_inst);

        // Validações básicas
        if (empty($nome) || empty($email) || empty($ra) || empty($data_nasc)) {
            throw new Exception("Campos obrigatórios não preenchidos: nome, email, RA ou data de nascimento");
        }

        // Verificar se o aluno existe e pertence à instituição
        error_log("Verificando se aluno existe...");
        $alunoExistente = $alunoObj->conferirCadAlunoForId($ra, $id_inst);
        error_log("Aluno existente: " . ($alunoExistente ? 'SIM' : 'NÃO'));
        
        if (!$alunoExistente) {
            throw new Exception("Aluno não encontrado ou não pertence a esta instituição");
        }

        // CORREÇÃO 3: Tratar a senha corretamente
        $senha = '';
        if (!empty($_POST['senha-aluno'])) {
            $senha = trim($_POST['senha-aluno']);
            error_log("Nova senha fornecida: SIM");
        } else {
            // Se não foi fornecida nova senha, manter a senha atual
            $senha = $alunoExistente['senha'];
            error_log("Mantendo senha atual");
        }

        error_log("Tentando atualizar aluno...");
        
        $resultado = $alunoObj->updateCadAluno(
            $ra,
            $nome,
            $email,
            $senha,
            $telefone,
            $turma,
            $data_nasc,
            $nomeResponsavel,
            $telefoneResponsavel,
            $id_inst
        );

        error_log("Resultado método updateCadAluno: " . var_export($resultado, true));

        if ($resultado) {
            error_log("Atualização bem-sucedida!");
            
            // Retornar resposta JSON para o JavaScript
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Aluno atualizado com sucesso!'
            ]);
            exit;
        } else {
            error_log("Atualização falhou - método retornou false");
            throw new Exception("Falha na atualização - método retornou false");
        }

    } catch (Exception $e) {
        error_log("ERRO CAPTURADO: " . $e->getMessage());
        error_log("Stack trace: " . $e->getTraceAsString());

        // Retornar erro em JSON
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        exit;
    }
} else {
    error_log("Nenhum dado POST recebido");
    
    // Retornar erro em JSON em vez de redirecionar
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Nenhum dado foi enviado'
    ]);
    exit;
}


?>