<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Usuário não autenticado']);
    exit;
}

require '../model/Instituicao.class.php';

$instObj = new Instituicao();

$id_inst = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    try {
        $nome = isset($_POST['nome-instituicao']) ? trim($_POST['nome-instituicao']) : '';
        $email = isset($_POST['email-contato']) ? trim($_POST['email-contato']) : '';
        $telefone = isset($_POST['telefone-contato']) ? trim($_POST['telefone-contato']) : '';
        $cep = isset($_POST['cep']) ? trim($_POST['cep']) : '';
        $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';
        $bairro = isset($_POST['bairro']) ? trim($_POST['bairro']) : '';
        $rua = isset($_POST['rua']) ? trim($_POST['rua']) : '';
        $num = isset($_POST['num']) ? trim($_POST['num']) : '';
        $senha = '';

        // Buscar dados atuais para manter senha se não for alterada
        $instAtual = $instObj->conferirCadInstituicao($id_inst);
        if (!$instAtual) {
            throw new Exception("Instituição não encontrada");
        }

        if (!empty($_POST['senha-instituicao'])) {
            $senha = trim($_POST['senha-instituicao']);
        } else {
            $senha = $instAtual['senha'];
        }

        // Validações básicas
        if (empty($nome) || empty($email)) {
            throw new Exception("Campos obrigatórios não preenchidos: nome ou email");
        }

        $resultado = $instObj->alterarCadInstituicao(
            $id_inst,
            $nome,
            $email,
            $senha,
            $telefone,
            $cep,
            $estado,
            $bairro,
            $rua,
            $num
        );

        if ($resultado) {
            echo json_encode([
                'success' => true,
                'message' => 'Instituição atualizada com sucesso!'
            ]);
        } else {
            throw new Exception("Falha na atualização da instituição");
        }
    } catch (Exception $e) {
        error_log("Erro ao atualizar instituição: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Nenhum dado foi enviado'
    ]);
}
?>
