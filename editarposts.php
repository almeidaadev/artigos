<?php

require "./Database/Connection/Connection.php";

function so() {
    return strtolower(PHP_OS);
}

$mysqli = $conn;

$imagens = [];

if (isset($_FILES) && count($_FILES) > 0) {
    $files = $_FILES["files"];

    if (so() == "linux") {
        $pasta = "/var/www/html/crudArtigoss/images/";
        $explodeBase = "html";
    } else {
        $pasta = "C:/laragon/www/crudArtigos/images/";
        $explodeBase = "www";
    }

    foreach ($files["name"] as $index => $file) {
        $extensao = pathinfo($file, PATHINFO_EXTENSION);
        $novoNomeImagem = uniqid();
        $path = $pasta . $novoNomeImagem . "." . $extensao;

        $deu_certo = move_uploaded_file($files["tmp_name"][$index], $path);
        $explode = explode($explodeBase, $pasta);

        if ($deu_certo) {    
            echo "Imagem salva com sucesso.\n"; 
            $imagens[] = $explode[1] . $novoNomeImagem . "." . $extensao;
        } else {
            echo "Erro ao salvar a imagem.\n";
        }
    }
}

$imagePathString = implode(",", $imagens);

// Verificação dos campos do formulário

if (empty($_POST["id"]) || empty($_POST["titulo"]) || empty($_POST["conteudo"]) || empty($_POST["id_categoria"]) || empty($_POST["tags"])) {
    die("Preencha todos os campos.");
}

$id = $_POST["id"];
$titulo = $_POST["titulo"];
$conteudo = $_POST["conteudo"];
$categoria = $_POST["id_categoria"];
$subcat = $_POST["id_subcategorrias"];
$tags = $_POST["tags"];
$date = date('Y/m/d');

$query = "UPDATE art SET titulo=?, conteudo=?, id_categoria=?, id_tags=?, image=?, dt_criada=? WHERE id=?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ssisssi", $titulo, $conteudo, $categoria, $tags, $imagePathString, $date, $id);

if ($stmt->execute()) {
    echo "Artigo atualizado com sucesso.";
} else {
    echo "Erro ao atualizar o artigo: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
