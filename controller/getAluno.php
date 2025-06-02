<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

require '../model/Aluno.class.php';

// Verificar se o ID foi fornecido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ID do aluno não fornecido']);
    exit;
}

$id_aluno = $_GET['id'];
$id_inst = $_SESSION['id'];

try {
    $alunoObj = new Aluno();
    
    // Buscar a criança específica e verificar se pertence ao responsável logado
    $aluno = $alunoObj->conferirCadAlunoForId($id_aluno, $id_inst);
    
    if ($aluno) {
        // Retornar os dados da criança
        echo json_encode([
            'success' => true,
            'aluno' => [
                'id' => $aluno['ra'],
                'nome' => $aluno['nome'],
                'email' => $aluno['email'],
                'telefone' => $aluno['tell'],
                'dataNasc' => $aluno['dataNasc'],
                'nomeResponsavel' => $aluno['nome_responsavel'],
                'telefoneResponsavel' => $aluno['tell_responsavel'],
                'turma' => $aluno['turma']
            ]
        ]);
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Aluno não encontrada ou não pertence a esta instituição']);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    error_log("Erro ao buscar aluno: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Erro interno do servidor']);
}
?>