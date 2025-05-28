<?php
session_start();

require '../model/Instituicao.class.php';

$conecta = $inst = new Instituicao();

if (!$conecta) {
    echo "<h1>Erro ao conectar ao Banco de Dados!</h1>";
} else {
    if (isset($_POST['submit'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $cnpj = $_POST['cnpj'];
        $tipoInstituicao = $_POST['tipoInstituicao'];
        $dataCriacaoInst = $_POST['dataCriacaoInst'];
        $estado = $_POST['estado'];
        $bairro = $_POST['bairro'];
        $rua = $_POST['rua'];
        $num = $_POST['num'];
        $cep = $_POST['cep'];
        $telefone = $_POST['telefone'];

        $user = $inst->chkUser($email);
        if ($user) {
            echo "E-mail já Cadastrado!!!";
        } else {
            $inst->inserirCadInstituicao($nome, $email, $senha, $telefone, $cep, $estado, bairro: $bairro, rua: $rua, num: $num, cnpj: $cnpj, tipoInstituicao: $tipoInstituicao, dataCriacaoInst: $dataCriacaoInst);
        }
    }

    if (isset($_POST['btn-cad-comunicado'])) {
        $id_inst = $_POST['id_inst'];
        $titulo = $_POST['titulo-comunicado'];
        $destinatario = $_POST['destinatarios'];
        $descricao = $_POST['conteudo-comunicado'];
        $arquivo = $_POST['anexo'];

        // Processa o upload do arquivo
    if(isset($_FILES['anexo']) && $_FILES['anexo']['error'] == 0) {
        $pasta_upload = "../uploads/comunicados/";
        if (!file_exists($pasta_upload)) {
            mkdir($pasta_upload, 0777, true);
        }
        
        $nome_arquivo = time() . '_' . $_FILES['anexo']['name'];
        $caminho_arquivo = $pasta_upload . $nome_arquivo;
        
        if(move_uploaded_file($_FILES['anexo']['tmp_name'], $caminho_arquivo)) {
            // Arquivo foi enviado com sucesso
            // Salva no banco o caminho do arquivo
            $inst->inserirCadComunicado($titulo, $destinatario, $descricao, $caminho_arquivo, idInstituicao: $id_inst);
        } else {
            echo "Erro ao fazer upload do arquivo";
        }
    } else {
        // Sem arquivo anexo
        $inst->inserirCadComunicado($titulo, $destinatario, $descricao, null, idInstituicao: $id_inst);
    }
    }
}