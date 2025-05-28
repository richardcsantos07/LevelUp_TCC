<?php
session_start();

require '../model/Crianca.class.php';

$conecta = $crianca = new Crianca();
if(!$conecta){
    echo "<h1>Erro ao conectar ao Banco de Dados!</h1>";
} else {
    if(isset($_POST['btn-cad-crianca'])){

        $nome               = $_POST['nome-crianca'];
        $email              = $_POST['email-crianca'];
        $senha              = $_POST['senha-crianca'];
        $id_resp            = $_POST['id_resp'];
        $data_nasc          = $_POST['data-nascimento'];
        $telefone           = $_POST['telefone-crianca'];
        
        

        $user = $crianca->chkUser($email);
        if($user){
            echo "E-mail já Cadastrado!!!";
        }else{
            $crianca->inserirCadCri($nome, $email, $senha, $id_resp, dataNasc: $data_nasc, telefone: $telefone);
        }
    }
    header('location: ../view/MenuResponsavel.php');
}
