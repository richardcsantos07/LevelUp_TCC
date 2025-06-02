<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

require '../model/Instituicao.class.php';

$id_inst = $_SESSION['id'];

try {
    $instObj = new Instituicao();

    // Buscar dados da instituição
    $instituicao = $instObj->conferirCadInstituicao($id_inst);

    if ($instituicao) {
        // Retornar os dados da instituição
        echo json_encode([
            'success' => true,
            'instituicao' => [
                'id' => $instituicao['id'],
                'nome' => $instituicao['nome'],
                'email' => $instituicao['email'],
                'telefone' => $instituicao['telefone'],
                'cep' => $instituicao['cep'],
                'estado' => $instituicao['estado'],
                'bairro' => $instituicao['bairro'],
                'rua' => $instituicao['rua'],
                'num' => $instituicao['num']
            ]
        ]);
    } else {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Instituição não encontrada']);
    }
} catch (Exception $e) {
    http_response_code(500);
    error_log("Erro ao buscar instituição: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Erro interno do servidor']);
}
?>
