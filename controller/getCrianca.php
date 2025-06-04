<?php
session_start();

// Configurar headers para resposta JSON
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

// Verificar se o usuário está logado como criança
if (!isset($_SESSION['id']) || $_SESSION['tipo_usuario'] !== 'crianca') {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Acesso não autorizado']);
    exit;
}

require '../model/Crianca.class.php';

try {
    $criancaObj = new Crianca();
    
    // Buscar os dados da criança logada
    $crianca = $criancaObj->buscarCriancaPorId($_SESSION['id'], $_SESSION['id_resp']);
    
    if ($crianca) {
        echo json_encode([
            'success' => true,
            'crianca' => [
                'id' => $crianca['id'],
                'nome' => $crianca['nome'],
                'email' => $crianca['email'],
                'telefone' => $crianca['telefone'] ?? '-',
                'dataNasc' => $crianca['dataNasc'] ?? '-',
                'nomeResponsavel' => $crianca['nome_responsavel'] ?? '-',
                'telefoneResponsavel' => $crianca['telefone_responsavel'] ?? '-'
            ]
        ]);
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Dados da criança não encontrados']);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro interno do servidor']);
}
?>