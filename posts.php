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
        foreach ($files["name"] as $index => $file) {
            $extensao = pathinfo($file, PATHINFO_EXTENSION);
            
            $pasta = "/var/www/html/crudArtigoss/images/";
            $novoNomeImagem = uniqid();
            $path = $pasta . $novoNomeImagem . "." . $extensao;
           
            $deu_certo = move_uploaded_file($files["tmp_name"][$index], $path);
    
            $explode = explode("html", $pasta);
            
            if ($deu_certo) {    
                echo "Artigo criado"; 
                $imagens[] = $explode[1] . $novoNomeImagem . "." . $extensao;
            } else {
                echo "Ocorreu algum erro ao salvar a imagem";
            }
        }
    } else {
        foreach ($files["name"] as $index => $file) {
            $extensao = pathinfo($file, PATHINFO_EXTENSION);
            $pasta = "C:/laragon/www/crudArtigos/images/";
            $novoNomeImagem = uniqid();
            $path = $pasta . $novoNomeImagem . "." . $extensao;
           
            $deu_certo = move_uploaded_file($files["tmp_name"][$index], $path);
    
            $explode = explode("www", $pasta);
            
            if ($deu_certo) {                
                echo "Artigo criado"; 
                $imagens[] = $explode[1] . $novoNomeImagem . "." . $extensao;
            } else {
                echo "Ocorreu algum erro ao salvar a imagem";
            }
        }
    }
}

$imagePathString = implode(",", $imagens);
// $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);


// Verificação dos campos do formulário
if (empty($_POST["titulo"]) || empty($_POST["conteudo"]) || empty($_POST["id_categoria"]) || empty($_POST["tags"])) {
    die("Preencha todos os campos.");
}

$titulo = $_POST["titulo"];
$conteudo = $_POST["conteudo"];
$categoria = $_POST["id_categoria"];
$tags = $_POST["tags"];
$date = date('Y/m/d');
$mysqli->query("INSERT INTO art (titulo, conteudo, id_categoria, id_tags, image, dt_criada) VALUES ('$titulo', '$conteudo', '$categoria', '$tags', '$imagePathString', '$date')");



//if (in_array("", $_POST)) {
//    echo "Esta vazio";
//} else {
//    $titulo = $_POST["titulo"];
//    $conteudo = $_POST["conteudo"];
//    $categoria = $_POST["id_categoria"];
//    $tags = $_POST["tags"];
//    $date = date('Y/m/d');
//
//    $mysqli->query("INSERT INTO art (titulo, conteudo, id_categoria, id_tags, image, dt_criada) VALUES ('$titulo', '$conteudo', '$categoria', '$tags', '$imagePathString', '$date')");
//}


/*
<?php

require "./Database/Connection/Connection.php";

$mysqli = $conn;
$imagens = [];
$uploadOk = true;

// Verificar se há arquivos para upload
if (isset($_FILES["files"]) && !empty($_FILES["files"]["name"][0])) {
    $files = $_FILES["files"];
    $pasta = "/var/www/html/crudArtigoss/images/";

    foreach ($files["name"] as $index => $file) {
        $extensao = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $novoNomeImagem = uniqid();
        $path = $pasta . $novoNomeImagem . "." . $extensao;
        
        // Definir extensões permitidas
        $extensoesPermitidas = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($extensao, $extensoesPermitidas)) {
            echo "Arquivo não permitido: $file";
            $uploadOk = false;
            continue;
        }

        // Tentar mover o arquivo para o diretório de destino
        if (move_uploaded_file($files["tmp_name"][$index], $path)) {
            echo "Imagem salva com sucesso: $file<br>";
            $imagens[] = $path;
        } else {
            echo "Erro ao mover o arquivo: $file<br>";
            $uploadOk = false;
        }
    }
}

if (!$uploadOk) {
    exit("Erro ao processar imagens.");
}

// Converter array de imagens para string
$imagePathString = implode(",", $imagens);

// Verificação dos campos do formulário
if (empty($_POST["titulo"]) || empty($_POST["conteudo"]) || empty($_POST["id_categoria"]) || empty($_POST["tags"])) {
    exit("Preencha todos os campos.");
}

$titulo = $_POST["titulo"];
$conteudo = $_POST["conteudo"];
$categoria = $_POST["id_categoria"];
$tags = $_POST["tags"];
$date = date('Y/m/d');

// Inserção segura com Prepared Statements
$stmt = $mysqli->prepare("INSERT INTO art (titulo, conteudo, id_categoria, id_tags, image, dt_criada) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssisss", $titulo, $conteudo, $categoria, $tags, $imagePathString, $date);

if ($stmt->execute()) {
    echo "Artigo criado com sucesso!";
} else {
    echo "Erro ao criar artigo: " . $mysqli->error;
}

$stmt->close();
$mysqli->close();
?>
*/