<?php
session_start();

require '../model/Professor.class.php';

$conecta = $inst = new Professor();
if(!$conecta){
    echo "<h1>Erro ao conectar ao Banco de Dados!</h1>";
} else {
    if(isset($_POST['submit'])){
        $nome               = $_POST['nome'];
        $email              = $_POST['email'];
        $senha              = $_POST['senha'];
        $materia            = $_POST['materia'];
        $data_nasc          = $_POST['dataNasc'];
        $telefone           = $_POST['telefone'];
        $id_inst            = $_POST['id_inst'];
        

        $user = $inst->chkUser($email);
        if($user){
            echo "E-mail já Cadastrado!!!";
        }else{
            $inst->criarCadastroProf($nome, $email, $senha, $materia, $data_nasc, $telefone, $id_inst);
        }
    }
}