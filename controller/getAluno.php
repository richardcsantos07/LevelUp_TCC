<?php
session_start();
error_log("GET: " . print_r($_GET, true));
error_log("SESSION: " . print_r($_SESSION, true));

// Configurar headers para resposta JSON
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

// Incluir o arquivo da classe Aluno
$modelPath = '../model/Aluno.class.php';
if (!file_exists($modelPath)) {
    // Tentar caminho alternativo
    $modelPath = '../../model/Aluno.class.php';
    if (!file_exists($modelPath)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erro interno: Classe Aluno não encontrada']);
        exit;
    }
}

require $modelPath;

// Verificar se o ID foi fornecido (para instituição) ou usar o ID da sessão (para aluno)
$id_aluno = isset($_GET['id']) ? $_GET['id'] : null;
$id_inst = isset($_SESSION['id']) ? $_SESSION['id'] : null;

// Se for um aluno acessando seu próprio perfil
if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'aluno') {
    $id_aluno = $_SESSION['id'];
    $id_inst = $_SESSION['id_inst'];
}

// Se for uma instituição editando um aluno
else if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'instituicao') {
    if (!$id_aluno) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'ID do aluno não fornecido']);
        exit;
    }
}

// Caso contrário, acesso negado
else {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Acesso negado']);
    exit;
}

try {
    $alunoObj = new Aluno();
    
    // Buscar o aluno específico
    $aluno = $alunoObj->conferirCadAlunoForId($id_aluno, $id_inst);
    
    if ($aluno) {
        // Formatar os dados para resposta
        $response = [
            'success' => true,
            'aluno' => [
                'id' => $aluno['ra'],
                'ra' => $aluno['ra'], // Mantido para compatibilidade
                'nome' => $aluno['nome'],
                'email' => $aluno['email'],
                'telefone' => $aluno['tell'] ?? '',
                'tell' => $aluno['tell'] ?? '', // Mantido para compatibilidade
                'dataNasc' => $aluno['dataNasc'] ?? '',
                'nomeResponsavel' => $aluno['nome_responsavel'] ?? '',
                'nome_responsavel' => $aluno['nome_responsavel'] ?? '', // Mantido para compatibilidade
                'telefoneResponsavel' => $aluno['tell_responsavel'] ?? '',
                'tell_responsavel' => $aluno['tell_responsavel'] ?? '', // Mantido para compatibilidade
                'turma' => $aluno['turma'] ?? '',
                'senha' => $aluno['senha'] ?? '' // Adicionado se necessário
            ]
        ];
        
        echo json_encode($response);
    } else {
        http_response_code(404);
        echo json_encode([
            'success' => false, 
            'message' => 'Dados do aluno não encontrados'
        ]);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    error_log("Erro ao buscar aluno: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'Erro interno do servidor: ' . $e->getMessage()
    ]);
}
?>