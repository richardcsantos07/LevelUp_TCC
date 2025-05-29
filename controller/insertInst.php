<?php
session_start();

require '../model/Instituicao.class.php';

$conecta = $inst = new Instituicao();

if(!$conecta){
    echo "<h1>Erro ao conectar ao Banco de Dados!</h1>";
} else {
    if(isset($_POST['submit'])){
        $nome               = $_POST['nome'];
        $email              = $_POST['email'];
        $senha              = $_POST['senha'];
        $cnpj               = $_POST['cnpj'];
        $tipoInstituicao    = $_POST['tipoInstituicao'];
        $dataCriacaoInst    = $_POST['dataCriacaoInst'];
        $estado             = $_POST['estado'];
        $bairro             = $_POST['bairro'];
        $rua                = $_POST['rua'];
        $num                = $_POST['num'];
        $cep                = $_POST['cep'];
        $telefone           = $_POST['telefone']; 

        $user = $inst->chkUser($email);
        if($user){
            echo "E-mail já Cadastrado!!!";
        }else{
            $inst->inserirCadInstituicao($nome, $email, $senha, $telefone, $cep, $estado, bairro: $bairro, rua: $rua, num: $num, cnpj: $cnpj, tipoInstituicao: $tipoInstituicao, dataCriacaoInst: $dataCriacaoInst);
        }
    }
}