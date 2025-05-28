<?PHP
session_start();

if(!isset($_SESSION['id']) || !isset($_GET['id'])) {
    header("Location: ../view/MenuResponsavel.php");
    exit();
}

require_once('../model/Crianca.class.php');

$crianca = new Crianca();
$id = $_GET['id'];


try {
    if($crianca->deletarCadCri($id)) {
        header("Location: ../view/MenuResponsavel.php?success=1");
    } else {
        header("Location: ../view/MenuResponsavel.php?error=1");
    }
    exit();
} catch(Exception $e) {
    header("Location: ../view/MenuResponsavel.php?error=2");
    exit();
}
