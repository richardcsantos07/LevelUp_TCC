<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'Instituicao.class.php';

// Verifica se há uma sessão ativa com o ID da instituição
session_start();
if (!isset($_SESSION['id_inst'])) {
    echo json_encode(['error' => 'Sessão não encontrada']);
    exit;
}

$id_instituicao = $_SESSION['id_inst'];

try {
    $instituicao = new Instituicao();
    $comunicados = $instituicao->conferirCadComunicado($id_instituicao);
    
    // Organizar comunicados por data
    $comunicadosPorData = [];
    
    foreach ($comunicados as $comunicado) {
        $data = $comunicado['data_comunicado'];
        if (!isset($comunicadosPorData[$data])) {
            $comunicadosPorData[$data] = [];
        }
        $comunicadosPorData[$data][] = [
            'id' => $comunicado['id'],
            'titulo' => $comunicado['titulo'],
            'descricao' => $comunicado['descricao'],
            'destinatario' => $comunicado['destinatario'],
            'arquivo' => $comunicado['arquivo_upado']
        ];
    }
    
    echo json_encode($comunicadosPorData);
    
} catch (Exception $e) {
    echo json_encode(['error' => 'Erro ao buscar comunicados: ' . $e->getMessage()]);
}
?>