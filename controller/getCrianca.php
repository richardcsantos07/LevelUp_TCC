<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

require '../model/Crianca.class.php';

// Verificar se o ID foi fornecido
if (!isset($_GET['id']) || empty($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'ID da criança não fornecido']);
    exit;
}

$id_crianca = $_GET['id'];
$id_resp = $_SESSION['id'];

try {
    $criancaObj = new Crianca();
    
    // Buscar a criança específica e verificar se pertence ao responsável logado
    $crianca = $criancaObj->buscarCriancaPorId($id_crianca, $id_resp);
    
    if ($crianca) {
        // Retornar os dados da criança
        echo json_encode([
            'success' => true,
            'crianca' => [
                'id' => $crianca['id'],
                'nome' => $crianca['nome'],
                'email' => $crianca['email'],
                'telefone' => $crianca['telefone'],
                'dataNasc' => $crianca['dataNasc']
            ]
        ]);
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Criança não encontrada ou não pertence a este responsável']);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    error_log("Erro ao buscar criança: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Erro interno do servidor']);
}
?>