<?php
session_start();

require '../model/Professor.class.php';

require '../model/Instituicao.class.php';
require '../model/Responsavel.class.php';
require '../model/Crianca.class.php';

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $userType = $_POST['tipo_usuario'];

    if ($userType = 'aluno') {
        require '../model/Aluno.class.php';
        $aluno = new Aluno();

        $user = $aluno->chkUserPass($email, $senha);
        if (!empty($user)) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['senha'];
            $_SESSION['Acesslevel'] = $user['nivelAcesso'];
            header('location: ../view/html/MenuAluno.html');
        } else {
            echo "<script>
                            alert('Usuário ou Senha incorretos')
                    </script>";
        }

    } else if ($userType = 'professor') {
        require '../model/Professor.class.php';
        $prof = new Professor();

        $user = $prof->chkUserPass($email, $senha);
        if (!empty($user)) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['senha'];
            $_SESSION['Acesslevel'] = $user['nivelAcesso'];
            header('location: ../view/html/MenuProfessor.html');
        } else {
            echo "<script>
                            alert('Usuário ou Senha incorretos')
                    </script>";
            exit;
        }

    }
}

