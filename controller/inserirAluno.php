<?php
session_start();

require '../model/Aluno.class.php';

$conection = $aluno = new Aluno();

if(!$conection){
    echo "<h1>Erro ao conctar no Banco de Dados!</h1>";
} else {
    if(isset($_POST['submit'])){
        $ra         = $_POST['ra-aluno'];
        $nome       = $_POST['nome']; 
        $email      = $_POST['email'];
        $senha      = $_POST['senha'];
        $serie      = $_POST['serie'];
        $turma      = $_POST['turma'];
        $dataNasc   = $_POST['dataNasc'];
        $id_inst    = $_POST['id_inst'];

        $user = $aluno->chkUser($email);

        if($user){
            echo "E-mail já cadastrado!!";
        } else {
            $aluno->inserirCadAluno($ra, $nome, $email, $senha, $serie, $turma, $dataNasc, $id_inst);
        }
    }
}