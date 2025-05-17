<?php
session_start();

require '../model/Aluno.class.php';

$conection = $aluno = new Aluno();

if(!$conection){
    echo "<h1>Erro ao conctar no Banco de Dados!</h1>";
} else {
    if(isset($_POST['btn-cad-aluno'])){
        $ra                     = $_POST['ra-aluno'];
        $nome                   = $_POST['nome-aluno']; 
        $email                  = $_POST['email-aluno'];
        $senha                  = $_POST['senha-aluno'];
        $telefone               = $_POST['telefone-aluno'];
        $turma                  = $_POST['turma-aluno'];
        $dataNasc               = $_POST['data-nascimento'];
        $nome_responsavel       = $_POST['responsavel-aluno'];
        $telefone_responsavel   = $_POST['telefone-responsavel'];
        $id_inst                = $_POST['id_inst'];

        $user = $aluno->chkUser($email);

        if($user){
            echo "E-mail já cadastrado!!";
        } else {

            $aluno->inserirCadAluno($ra, $nome, $email, $senha, $telefone, $turma, dataNasc: $dataNasc, nomeResponsavel: $nome_responsavel, telefoneResponsavel: $telefone_responsavel, id_inst: $id_inst);
        }

        header("Location: ../view/MenuInstituicao.php");
    }
}