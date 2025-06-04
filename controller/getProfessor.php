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

// Verificar se é um professor
if ($_SESSION['tipo_usuario'] !== 'professor') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Acesso negado']);
    exit;
}

// Incluir o arquivo da classe Professor
$modelPath = '../model/Professor.class.php';
if (!file_exists($modelPath)) {
    // Tentar caminho alternativo
    $modelPath = '../../model/Professor.class.php';
    if (!file_exists($modelPath)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erro interno: Classe Professor não encontrada']);
        exit;
    }
}

require $modelPath;

// Verificar se o ID foi fornecido
$id_professor_param = isset($_GET['id']) ? $_GET['id'] : null;
$id_professor_session = $_SESSION['id'];

// Para segurança, usar sempre o ID da sessão
$id_professor = $id_professor_session;
$id_inst = isset($_SESSION['id_inst']) ? $_SESSION['id_inst'] : null;

if (!$id_inst) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ID da instituição não encontrado na sessão']);
    exit;
}

try {
    $professorObj = new Professor();
    
    // Buscar o professor específico
    $professor = $professorObj->buscarCadProfId($id_inst, $id_professor);
    
    if ($professor) {
        // Retornar os dados do professor
        echo json_encode([
            'success' => true,
            'professor' => [
                'id' => $professor['id'] ?? '',
                'nome' => $professor['nome'] ?? '',
                'email' => $professor['email'] ?? '',
                'telefone' => $professor['telefone'] ?? $professor['tell'] ?? '',
                'dataNasc' => $professor['dataNasc'] ?? '',
                'materia' => $professor['materia'] ?? '',
                'cpf' => $professor['cpf'] ?? ''
            ]
        ]);
    } else {
        http_response_code(404);
        echo json_encode([
            'success' => false, 
            'message' => 'Dados do professor não encontrados'
        ]);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    error_log("Erro ao buscar professor: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'Erro interno do servidor: ' . $e->getMessage()
    ]);
}
?>
