<?php
session_start();
require_once '../../model/Database.php';

header('Content-Type: application/json');

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

$studentId = $_GET['studentId'] ?? null;
$game = $_GET['game'] ?? null;

if (!$studentId || !$game) {
    echo json_encode(['success' => false, 'message' => 'Parâmetros inválidos']);
    exit;
}

try {
    $db = Database::getConnection();
    
    $stmt = $db->prepare("SELECT current_level, max_levels FROM game_progress 
                         WHERE student_id = ? AND game_name = ?");
    $stmt->execute([$studentId, $game]);
    $progress = $stmt->fetch();
    
    if ($progress) {
        echo json_encode([
            'success' => true,
            'progress' => [
                'level' => (int)$progress['current_level'],
                'maxLevels' => (int)$progress['max_levels']
            ]
        ]);
    } else {
        echo json_encode([
            'success' => true,
            'progress' => [
                'level' => 0,
                'maxLevels' => 0
            ]
        ]);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
}