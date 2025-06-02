<?php
session_start();

require '../model/Turma.class.php';

$conection = $turmaObj = new Turma();

if(!$conection){
    echo "<h1>Erro ao conctar no Banco de Dados!</h1>";
} else {
    if(isset($_POST['btn-cad-turma'])){
        
        $serie                  = $_POST['serie-turma']; 
        $turma                  = $_POST['turma'];
        $turno                  = $_POST['turno-turma'];
        $id_inst                = $_POST['id_inst'];
        $turma_conc = $serie . "º " . $turma . " - " . $turno;

        $user = $turmaObj->chkTurma($turma_conc, $id_inst);

        if($user){
            echo "Turma já cadastrada!!";
        } else {

            $turmaObj->inserirTurma($turma_conc, $id_inst);
        }

        header("Location: ../view/MenuInstituicao.php");
    }
}