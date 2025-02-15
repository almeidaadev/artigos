<?php
session_start();

require "./Database/Connection/Connection.php";

function get_so() { return  strtolower(PHP_OS); }

$mysqli = $conn;
$imagens = [];
$uploadOk = true;

if (isset($_FILES["files"]) && !empty($_FILES["files"]["name"][0])) {
    $files = $_FILES["files"];
    if (get_so() == "linux") {
        $pasta = "/var/www/html/crudArtigoss/images/";
        $explodePasta = explode("html", $pasta);
    } else {
        $pasta = "C:/laragon/www/crudArtigoss/imagens/";
        $explodePasta = explode("www", $pasta);
    }

    foreach ($files["name"] as $index => $file) {
        $extensao = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $novoNomeImagem = uniqid();
        $path = $pasta . $novoNomeImagem . "." . $extensao;

        $extensoesPermitidas = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($extensao, $extensoesPermitidas)) {
            $_SESSION['mensagem'] = ['tipo' => 'error', 'texto' => "Arquivo não permitido: $file"];
            $uploadOk = false;
            continue;
        }

        if (move_uploaded_file($files["tmp_name"][$index], $path)) {
            $imagens[] = $explodePasta[1] . $novoNomeImagem . "." . $extensao;
        } else {
            $_SESSION['mensagem'] = ['tipo' => 'error', 'texto' => "Erro ao mover o arquivo: $file"];
            $uploadOk = false;
        }
    }
}

if (!$uploadOk) {
    header("Location: index.php");
    exit;
}

$imagePathString = implode(",", $imagens);

$titulo = $_POST["titulo"];
$conteudo = $_POST["conteudo"];
$categoria = $_POST["id_categoria"];
$tags = $_POST["tags"];
$date = date('Y/m/d');

$_SESSION['info_form'] = ['titulo' => $titulo, 'conteudo' => $conteudo, 'categoria' => $categoria, 'tags' => $tags];
if (empty($_POST["titulo"]) || empty($_POST["conteudo"]) || empty($_POST["id_categoria"]) || empty($_POST["tags"])) {
    $_SESSION['mensagem'] = ['tipo' => 'error', 'texto' => "Preencha todos os campos."];
    header("Location: criar.php");
    exit;
}

$queryInsert = "INSERT INTO art (titulo, conteudo, id_categoria, id_tags, image, dt_criada) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($queryInsert);
$stmt->bind_param("ssisss", $titulo, $conteudo, $categoria, $tags, $imagePathString, $date);

if ($stmt->execute()) {
    $_SESSION['mensagem'] = ['tipo' => 'success', 'texto' => "Artigo criado com sucesso!"];
} else {
    $_SESSION['mensagem'] = ['tipo' => 'error', 'texto' => "Erro ao criar artigo: " . $mysqli->error];
}

$stmt->close();
$mysqli->close();
header("Location: index.php");
exit;
