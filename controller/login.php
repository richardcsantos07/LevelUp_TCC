<?php
session_start();





if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $userType = $_POST['tipo_usuario'];
    $_SESSION['tipo_usuario'] = $userType;

    if ($userType == 'aluno') {
        require '../model/Aluno.class.php';
        $aluno = new Aluno();

        $user = $aluno->chkUserPass($email, $senha);
        if (!empty($user)) {
            $_SESSION['id'] = $user['ra'];
            $_SESSION['id_inst'] = $user['id_inst'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['senha'];
            $_SESSION['Acesslevel'] = $user['nivelAcesso'];
            $_SESSION['nome'] = $user['nome'];
            header('location: ../view/html/MenuAluno.php');
        } else {
            echo "<script>
                            alert('Usuário ou Senha incorretos')
                    </script>";
        }

    } else if ($userType == 'professor') {
        require '../model/Professor.class.php';
        $prof = new Professor();

        $user = $prof->chkUserPass($email, $senha);
        if (!empty($user)) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['id_inst'] = $user['id_inst'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['senha'];
            $_SESSION['Acesslevel'] = $user['nivelAcesso'];
            $_SESSION['nome'] = $user['nome'];
            header('location: ../view/html/MenuProfessor.php');
        } else {
            echo "<script>
                            alert('Usuário ou Senha incorretos')
                    </script>";
            exit;
        }

    } else if ($userType == 'instituicao') {
        require '../model/Instituicao.class.php';
        $inst = new Instituicao();

        $user = $inst->chkUserPass($email, $senha);
        if (!empty($user)) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['senha'];
            $_SESSION['Acesslevel'] = $user['nivelAcesso'];
            header('location: ../view/MenuInstituicao.php');
        } else {
            echo "<script>
                            alert('Usuário ou Senha incorretos')
                    </script>";
            exit;
        }

    } else if ($userType == 'responsavel') {
        require '../model/Responsavel.class.php';
        $resp= new Responsavel();

        $user = $resp->chkUserPass($email, $senha);
        if (!empty($user)) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['senha'];
            $_SESSION['Acesslevel'] = $user['nivelAcesso'];
            $_SESSION['nome'] = $user['nome'];
            header('location: ../view/MenuResponsavel.php');
        } else {
            echo "<script>
                            alert('Usuário ou Senha incorretos')
                    </script>";
            exit;
        }

    } else if ($userType == 'crianca') {
        require '../model/Crianca.class.php';
        $crianca = new Crianca();

        $user = $crianca->chkUserPass($email, $senha);
        if (!empty($user)) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['senha'];
            $_SESSION['Acesslevel'] = $user['nivelAcesso'];
            $_SESSION['nome'] = $user['nome'];
            $_SESSION['id_resp'] = $user['idResponsavel'];
            header('location: ../view/MenuCrianca.php');
        } else {
            echo "<script>
                            alert('Usuário ou Senha incorretos')
                    </script>";
            exit;
        }

    }
}

