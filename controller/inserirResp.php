<?php
session_start();

require '../model/Responsavel.class.php';

$conecta = $resp = new Responsavel();
if(!$conecta){
    echo "<h1>Erro ao conectar ao Banco de Dados!</h1>";
} else {
    if(isset($_POST['submit'])){
        $nome               = $_POST['nome'];
        $email              = $_POST['email'];
        $senha              = $_POST['senha'];
        $cpf                = $_POST['cpf'];
        $data_nasc          = $_POST['data_nasc'];
        $telefone           = $_POST['telefone'];
        
        

        $user = $resp->chkUser($email);
        if($user){
            echo "E-mail já Cadastrado!!!";
        }else{
            $resp->criarCadastroResp($nome, $email, $senha, $data_nasc, $telefone, cpf: $cpf);
        }
    }
}