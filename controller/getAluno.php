<?php
session_start();

// Configurar headers para resposta JSON
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

// Verificar se o usuário está logado
if (!isset($_SESSION['id']) || !isset($_SESSION['tipo_usuario'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

// Verificar se é um aluno
if ($_SESSION['tipo_usuario'] !== 'aluno') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Acesso negado']);
    exit;
}

// Incluir o arquivo da classe Aluno
$modelPath = '../model/Aluno.class.php';
if (!file_exists($modelPath)) {
    // Tentar caminho alternativo
    $modelPath = '../../model/Aluno.class.php';
    if (!file_exists($modelPath)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erro interno: Classe Aluno não encontrada']);
        exit;
    }
}

require $modelPath;

// Verificar se o ID foi fornecido
$id_aluno_param = isset($_GET['id']) ? $_GET['id'] : null;
$id_aluno_session = $_SESSION['id'];

// Para segurança, usar sempre o ID da sessão
$id_aluno = $id_aluno_session;
$id_inst = isset($_SESSION['id_inst']) ? $_SESSION['id_inst'] : null;

if (!$id_inst) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ID da instituição não encontrado na sessão']);
    exit;
}

try {
    $alunoObj = new Aluno();
    
    // Buscar o aluno específico
    $aluno = $alunoObj->conferirCadAlunoForId($id_aluno, $id_inst);
    
    if ($aluno) {
        // Retornar os dados do aluno
        echo json_encode([
            'success' => true,
            'aluno' => [
                'id' => $aluno['ra'],
                'nome' => $aluno['nome'],
                'email' => $aluno['email'],
                'telefone' => $aluno['tell'] ?? '',
                'dataNasc' => $aluno['dataNasc'] ?? '',
                'nomeResponsavel' => $aluno['nome_responsavel'] ?? '',
                'telefoneResponsavel' => $aluno['tell_responsavel'] ?? '',
                'turma' => $aluno['turma'] ?? ''
            ]
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'success' => false, 
            'message' => 'Dados do aluno não encontrados'
        ]);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    error_log("Erro ao buscar aluno: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'Erro interno do servidor: ' . $e->getMessage()
    ]);
}
?>