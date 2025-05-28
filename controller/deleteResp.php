<?PHP
session_start();

if(!isset($_SESSION['id'])) {
    header("Location: ../view/MenuResponsavel.php");
    exit();
}


require_once('../model/Responsavel.class.php');

$responsavel = new Responsavel();

$id = $_SESSION['id'];


try {
    if($responsavel->deletarCadResp($id)) {
        header("Location: ../view/MenuResponsavel.php?success=1");
    } else {
        header("Location: ../view/MenuResponsavel.php?error=1");
    }
    exit();
} catch(Exception $e) {
    header("Location: ../view/MenuResponsavel.php?error=2");
    exit();
}
