<?PHP
session_start();

if(!isset($_SESSION['id']) || !isset($_GET['id'])) {
    header("Location: ../view/MenuInstituicao.php");
    exit();
}

require_once('../model/Turma.class.php');

$turma = new Turma();
$id = $_GET['id'];
$id_inst = $_SESSION['id'];

try {
    if($turma->excluirTurma($id, $id_inst)) {
        header("Location: ../view/MenuInstituicao.php?success=1");
    } else {
        header("Location: ../view/MenuInstituicao.php?error=1");
    }
    exit();
} catch(Exception $e) {
    header("Location: ../view/MenuInstituicao.php?error=2");
    exit();
}
