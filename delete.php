<?php 

session_start();

require "./Database/Connection/Connection.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $queryDelete = "DELETE FROM art WHERE id = ?";
    $stmt = $conn->prepare($queryDelete);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = ['tipo' => 'success', 'texto' => "Artigo deletado com sucesso!"];
    } else {
        $_SESSION['mensagem'] = ['tipo' => 'error', 'texto' => "Erro ao deletar o artigo!"];
    }

    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit;
} else {
    $_SESSION['mensagem'] = ['tipo' => 'error', 'texto' => "ID inválido!"];
    header("Location: index.php");
    exit;
}
