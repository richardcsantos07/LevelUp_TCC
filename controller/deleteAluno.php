<?PHP
session_start();

if(!isset($_SESSION['id']) || !isset($_GET['id'])) {
    header("Location: ../view/MenuInstituicao.php");
    exit();
}

require_once('../model/Aluno.class.php');

$aluno = new Aluno();
$ra = $_GET['id'];
$id_inst = $_SESSION['id'];

try {
    if($aluno->excluirAluno($ra, $id_inst)) {
        header("Location: ../view/MenuInstituicao.php?success=1");
    } else {
        header("Location: ../view/MenuInstituicao.php?error=1");
    }
    exit();
} catch(Exception $e) {
    header("Location: ../view/MenuInstituicao.php?error=2");
    exit();
}
