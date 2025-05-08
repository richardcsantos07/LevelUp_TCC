<?php
require_once '../model/Instituicao.class.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo-comunicado'] ?? '';
    $conteudo = $_POST['conteudo-comunicado'] ?? '';
    $destinatarios = is_array($_POST['destinatarios']) 
        ? implode(',', $_POST['destinatarios']) 
        : $_POST['destinatarios'];
    $instituicao_id = $_SESSION['id'] ?? null;

    try {
        $instituicao = new Instituicao();
        $pdo = $instituicao->getPdo(); // deve retornar um objeto PDO

        $sql = "INSERT INTO comunicado (titulo, conteudo, destinatarios, instituicao_id) 
                VALUES (:titulo, :conteudo, :destinatarios, :instituicao_id)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':conteudo', $conteudo);
        $stmt->bindParam(':destinatarios', $destinatarios);
        $stmt->bindParam(':instituicao_id', $instituicao_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Comunicado inserido com sucesso!";
        } else {
            echo "Erro ao inserir comunicado.";
        }

    } catch (PDOException $e) {
        echo "Erro de conexão ou execução: " . $e->getMessage();
    }
}
header('location: ../view/MenuInstituicao.php');
?>
