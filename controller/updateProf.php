<?php
session_start();

// Definir header JSON desde o início
header('Content-Type: application/json');

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

require '../model/Professor.class.php';

$professorObj = new Professor();

if (!$professorObj) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro ao conectar ao Banco de Dados']);
    exit;
}

// DEPURAÇÃO: Log dos dados recebidos
error_log("=== INÍCIO ATUALIZAÇÃO PROFESSOR ===");
error_log("POST recebido: " . print_r($_POST, true));
error_log("SESSION ID: " . $_SESSION['id']);

// Verificar se há dados POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    try {
        // Capturar dados com os nomes corretos dos campos
        $id = isset($_POST['id-professor']) ? (int) $_POST['id-professor'] : 0;
        $nome = isset($_POST['nome-professor']) ? trim($_POST['nome-professor']) : '';
        $email = isset($_POST['email-professor']) ? trim($_POST['email-professor']) : '';
        $data_nasc = isset($_POST['data-nascimento']) ? $_POST['data-nascimento'] : '';
        $telefone = isset($_POST['telefone-professor']) ? trim($_POST['telefone-professor']) : '';
        $id_inst = $_SESSION['id'];
        
        // CORREÇÃO: Usar os nomes corretos dos campos
        $materia = isset($_POST['materia-professor']) ? trim($_POST['materia-professor']) : '';
        $cpf = isset($_POST['cpf-professor']) ? trim($_POST['cpf-professor']) : '';
        
        // DEPURAÇÃO: Log dos dados processados
        error_log("Dados processados para atualização:");
        error_log("ID: " . $id);
        error_log("Nome: " . $nome);
        error_log("Email: " . $email);
        error_log("Data Nasc: " . $data_nasc);
        error_log("Telefone: " . $telefone);
        error_log("Materia: " . $materia);
        error_log("CPF: " . $cpf);
        error_log("ID Instituição: " . $id_inst);

        // Validações básicas
        if (empty($nome) || empty($email) || empty($id) || empty($data_nasc)) {
            throw new Exception("Campos obrigatórios não preenchidos: nome, email, id ou data de nascimento");
        }

        // Verificar se o professor existe e pertence à instituição
        error_log("Verificando se professor existe...");
        $professorExistente = $professorObj->buscarCadProfId($id_inst, $id);
        error_log("Professor existente: " . ($professorExistente ? 'SIM' : 'NÃO'));
        
        if (!$professorExistente) {
            throw new Exception("Professor não encontrado ou não pertence a esta instituição");
        }

        // Tratar a senha corretamente
        $senha = '';
        if (!empty($_POST['senha-professor'])) {
            $senha = trim($_POST['senha-professor']);
            error_log("Nova senha fornecida: SIM");
        } else {
            // Se não foi fornecida nova senha, manter a senha atual
            $senha = $professorExistente['senha'];
            error_log("Mantendo senha atual");
        }

        error_log("Tentando atualizar professor...");
        
        // Verificar se o método updateCadProf existe e seus parâmetros
        if (!method_exists($professorObj, 'updateCadProf')) {
            throw new Exception("Método updateCadProf não encontrado na classe Professor");
        }
        
        $resultado = $professorObj->updateCadProf(
            $id,
            $nome,
            $email,
            $senha,
            $materia,
            $cpf,
            $data_nasc,
            $telefone,
            $id_inst
        );

        error_log("Resultado método updateCadProf: " . var_export($resultado, true));

        if ($resultado) {
            error_log("Atualização bem-sucedida!");
            echo json_encode([
                'success' => true,
                'message' => 'Professor atualizado com sucesso!'
            ]);
        } else {
            error_log("Atualização falhou - método retornou false");
            throw new Exception("Falha na atualização - método retornou false");
        }

    } catch (Exception $e) {
        error_log("ERRO CAPTURADO: " . $e->getMessage());
        error_log("Stack trace: " . $e->getTraceAsString());

        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
} else {
    error_log("Nenhum dado POST recebido");
    
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Nenhum dado foi enviado'
    ]);
}

error_log("=== FIM ATUALIZAÇÃO PROFESSOR ===");
?>