<?php
session_start();
require_once '../model/Jogo.class.php';

header('Content-Type: application/json');

// Log para debug
error_log("getGameProgress.php chamado");
error_log("Sessão ID: " . (isset($_SESSION['id']) ? $_SESSION['id'] : 'não setado'));

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    error_log("Usuário não autenticado");
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

$studentId = $_GET['studentId'] ?? null;
$game = $_GET['game'] ?? null;

error_log("StudentId recebido: " . ($studentId ?? 'null'));
error_log("Game recebido: " . ($game ?? 'null'));

if (!$studentId || !$game) {
    error_log("Parâmetros inválidos - studentId: $studentId, game: $game");
    echo json_encode(['success' => false, 'message' => 'Parâmetros inválidos']);
    exit;
}

try {
    $jogo = new Jogo();
    
    // Verificar se a conexão foi estabelecida
    if (!$jogo->isConnected()) {
        throw new Exception("Não foi possível conectar ao banco de dados");
    }
    
    $db = $jogo->getPDO();
    
    // Query com log para debug
    $query = "SELECT current_level, max_levels FROM game_progress 
              WHERE id_aluno = ? AND game_name = ?";
    error_log("Query: $query");
    error_log("Parâmetros: id_aluno = $studentId, game_name = $game");
    
    $stmt = $db->prepare($query);
    $stmt->execute([$studentId, $game]);
    $progress = $stmt->fetch(PDO::FETCH_ASSOC);
    
    error_log("Resultado da query: " . print_r($progress, true));
    
    if ($progress) {
        $response = [
            'success' => true,
            'progress' => [
                'level' => (int)$progress['current_level'],
                'maxLevels' => (int)$progress['max_levels']
            ]
        ];
        error_log("Progresso encontrado: " . json_encode($response));
        echo json_encode($response);
    } else {
        // Se não encontrar registro, retorna nível 0
        $response = [
            'success' => true,
            'progress' => [
                'level' => 0,
                'maxLevels' => 0
            ]
        ];
        error_log("Nenhum progresso encontrado, retornando nível 0");
        echo json_encode($response);
    }
} catch (PDOException $e) {
    error_log("Erro PDO: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
} catch (Exception $e) {
    error_log("Erro geral: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()]);
}
?>