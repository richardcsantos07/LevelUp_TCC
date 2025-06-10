<?php
session_start();
require_once '../../model/Database.php';

header('Content-Type: application/json');

// Verificar se o usuário está logado
if (!isset($_SESSION['id']) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['studentId']) || !isset($data['game']) || !isset($data['level'])) {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
    exit;
}

try {
    $db = Database::getConnection();
    
    // Verificar se já existe um registro para este aluno e jogo
    $stmt = $db->prepare("SELECT id FROM game_progress WHERE student_id = ? AND game_name = ?");
    $stmt->execute([$data['studentId'], $data['game']]);
    $existing = $stmt->fetch();
    
    if ($existing) {
        // Atualizar registro existente se o novo nível for maior
        $stmt = $db->prepare("UPDATE game_progress SET current_level = ?, max_levels = ?, updated_at = NOW() 
                             WHERE id = ? AND current_level < ?");
        $stmt->execute([$data['level'], $data['maxLevels'], $existing['id'], $data['level']]);
    } else {
        // Criar novo registro
        $stmt = $db->prepare("INSERT INTO game_progress (student_id, game_name, current_level, max_levels) 
                             VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['studentId'], $data['game'], $data['level'], $data['maxLevels']]);
    }
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
}