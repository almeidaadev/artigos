<?php

session_start();

require "./Database/Connection/Connection.php";

$querySelectCategoria = "SELECT * FROM categoria";
$querySelectTags = "SELECT * FROM tags";

$resultQueryCategoria = $conn->query($querySelectCategoria);
$resultQuerySelectTags = $conn->query($querySelectTags);


// Informations input session

$info_form = [
    'titulo' => $_SESSION['info_form']['titulo'],
    'conteudo' => $_SESSION['info_form']['conteudo'],
]
    
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Artigo</title>
    
    <!-- JS  -->    
    <script type="module" src="./scripts/index.js" defer></script>
    
    <!-- CSS  -->
    <link rel="stylesheet" href="./css/style.css?v=<?= time(); ?>">
    
    <!-- CSS do Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- JavaScript do Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.js"></script>

    <!-- BOOTSTRAP IMPORT  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</head>
<body>
    <?php 
        require "./components/header.php";
    ?>

    <main class="container">
        <h1>Criar Artigo</h1>
        <form  method="POST" action="posts.php" enctype="multipart/form-data">
            <label class="form-label" for="title" >Título:</label><br>
            <input class="form-control" value="<?= !empty($info_form['titulo']) ?  $info_form['titulo'] : ''?>" type="text" name="titulo" id="title" autocomplete="off"><br><br>
    
            <label class="form-label" for="content">Conteúdo:</label><br>
            <textarea name="conteudo"  id="content"></textarea><br><br>
    
            <label class="form-label" value="<?= !empty($info_form['conteudo']) ?  $info_form['conteudo'] : ''?>" for="categoria">Categoria:</label><br>
            
            <div class="row">
                <div class="col-md-6">
                    <select name="id_categoria" class="form-select mb-4" id="categoria">
                        <option>Informe uma categoria</option>
                        <?php while ($rowCat = $resultQueryCategoria->fetch_assoc()): ?>
                            <option value="<?= $rowCat["id_categoria"]; ?>"><?= $rowCat["categorias"]; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>


                <div class="col-md-6">
                    <div class="container_subcategorias">
                        <select id="subcategorias" name="id_subcategorias" class="form-select mb-4" disabled>
                            <option>Selecione uma categoria primeiro</option>
                        </select>
                    </div>
                </div>
            </div>

            <label class="form-label" for="tags">Tags:</label><br>

            <select name="tags" class="form-select mb-4">
                <?php while ($row = $resultQuerySelectTags->fetch_assoc()):?>
                    <option value="<?= $row["id_tags"]; ?>"><?= $row["tags"]; ?></option>
                <?php endwhile; ?>
            </select>

            <label class="form-label" for="image">Imagem:</label><br>
            <input multiple name="files[]" type="file" class="form-control imageInput" id="image"><br>
    
            <img id="imagePreview" alt="Pré-visualização da imagem"><br><br>
            <button type="submit" class="btn btn-primary">Criar Postagem</button>
        </form>
    </main>

    <?php include "menssagem.php" ?>

</body>
</html>
