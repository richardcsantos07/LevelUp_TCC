<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

require '../model/Professor.class.php';

// Verificar se o ID foi fornecido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ID do professor não fornecido']);
    exit;
}

$id_professor = $_GET['id'];
$id_inst = $_SESSION['id'];

// Log para debug
error_log("Buscando professor - ID: $id_professor, Instituição: $id_inst");

try {
    $professorObj = new Professor();

    // Buscar o professor específico e verificar se pertence à instituição logada
    $professor = $professorObj->buscarCadProfId($id_inst, $id_professor);

    if ($professor) {
        // Log dos dados encontrados
        error_log("Professor encontrado: " . json_encode($professor));
        
        // Retornar os dados do professor com verificação de campos
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
        error_log("Professor não encontrado - ID: $id_professor, Instituição: $id_inst");
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Professor não encontrado ou não pertence a esta instituição']);
    }

} catch (Exception $e) {
    http_response_code(500);
    error_log("Erro ao buscar professor: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Erro interno do servidor: ' . $e->getMessage()]);
}
?>