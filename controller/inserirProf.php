<?php
session_start();

require '../model/Professor.class.php';

$conecta = $inst = new Professor();
if(!$conecta){
    echo "<h1>Erro ao conectar ao Banco de Dados!</h1>";
} else {
    if(isset($_POST['btn-cad-professor'])){
        $nome               = $_POST['nome-professor'];
        $email              = $_POST['email-professor'];
        $senha              = $_POST['senha-professor'];
        $materia            = $_POST['disciplina'];
        $cpf                = $_POST['cpf-professor'];
        $data_nasc          = $_POST['data-nascimento-professor'];
        $telefone           = $_POST['telefone-professor'];
        $id_inst            = $_POST['id_inst'];
        

        $user = $inst->chkUser($email);
        if($user){
            echo "E-mail já Cadastrado!!!";
        }else{
            $inst->criarCadastroProf($nome, $email, $senha, $materia, $cpf, data_nasc: $data_nasc, telefone: $telefone, id_inst: $id_inst);
        }
    }
}