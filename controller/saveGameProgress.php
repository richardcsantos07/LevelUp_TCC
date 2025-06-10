<?php
session_start();
require '../model/Jogo.class.php';

header('Content-Type: application/json');

// Log para debug
error_log("saveGameProgress.php chamado");
error_log("Sessão ID: " . (isset($_SESSION['id']) ? $_SESSION['id'] : 'não setado'));

if (!isset($_SESSION['id'])) {
    error_log("Usuário não autenticado");
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

error_log("Dados recebidos: " . print_r($data, true));

if (!$data || !isset($data['game']) || !isset($data['level'])) {
    error_log("Dados inválidos recebidos");
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
    exit;
}

// Usar diretamente o ID da sessão como studentId
$studentId = $_SESSION['id'];

// Validar dados antes de processar
if ($data['level'] < 0 || ($data['maxLevels'] && $data['level'] > $data['maxLevels'])) {
    echo json_encode(['success' => false, 'message' => 'Nível inválido']);
    exit;
}

try {
    $jogo = new Jogo();
    $db = $jogo->getPDO();
    
    // Verificar se já existe um registro para este aluno e jogo
    $stmt = $db->prepare("SELECT id, current_level FROM game_progress 
                         WHERE id_aluno = ? AND game_name = ?");
    $stmt->execute([$studentId, $data['game']]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($existing) {
        // Atualizar registro existente apenas se o novo nível for maior
        if ($data['level'] > $existing['current_level']) {
            $stmt = $db->prepare("UPDATE game_progress 
                                 SET current_level = ?, max_levels = ?, updated_at = NOW() 
                                 WHERE id = ?");
            $stmt->execute([$data['level'], $data['maxLevels'], $existing['id']]);
            error_log("Progresso atualizado: nível {$data['level']} para aluno {$studentId}");
        }
    } else {
        // Criar novo registro
        $stmt = $db->prepare("INSERT INTO game_progress 
                             (id_aluno, game_name, current_level, max_levels, created_at, updated_at) 
                             VALUES (?, ?, ?, ?, NOW(), NOW())");
        $stmt->execute([$studentId, $data['game'], $data['level'], $data['maxLevels']]);
        error_log("Novo progresso criado: nível {$data['level']} para aluno {$studentId}");
    }
    
    echo json_encode(['success' => true, 'message' => 'Progresso salvo com sucesso']);
    // REMOVIDO: header('Location: ../view/html/MenuAluno.php'); - Não deve redirecionar em AJAX
    
} catch (PDOException $e) {
    error_log("Erro PDO: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
} catch (Exception $e) {
    error_log("Erro geral: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Erro interno: ' . $e->getMessage()]);
}
?>