<?PHP
session_start();

if(!isset($_SESSION['id']) || !isset($_GET['id'])) {
    header("Location: ../view/MenuInstituicao.php");
    exit();
}

require_once('../model/Professor.class.php');

$professor = new Professor();
$id = $_GET['id'];
$id_inst = $_SESSION['id'];

try {
    if($professor->excluirProf($id, $id_inst)) {
        header("Location: ../view/MenuInstituicao.php?success=1");
    } else {
        header("Location: ../view/MenuInstituicao.php?error=1");
    }
    exit();
} catch(Exception $e) {
    header("Location: ../view/MenuInstituicao.php?error=2");
    exit();
}
