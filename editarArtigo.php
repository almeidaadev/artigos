<?php

require "./Database/Connection/Connection.php";

$querySelectTags = "SELECT * FROM tags";
$resultQuerySelectTags = $conn->query($querySelectTags);

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "SELECT * FROM art WHERE id = $id";
    $result = $conn->query($query);

    if (!$result) {
        die("Ocorrou algum erro inesperado");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Artigo</title>

    <!-- CSS  -->
    <link rel="stylesheet" href="./css/style.css?v=<?= time(); ?>">
    
    <!-- JS  -->
    <script type="module" src="./scripts/index.js" defer></script>

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
        include "./components/header.php";
    ?>

    <main class="container">
        <h1>Editar Artigo</h1>
    
        <form  method="POST" action="editarposts.php" enctype="multipart/form-data">
            <?php while ($row = $result->fetch_assoc()):?>
                <input type="hidden" name="id" value="<?= $id ?>">
                <label class="form-label" for="title" >Título:</label><br>
                <input class="form-control" type="text" value="<?= $row["titulo"]; ?>" name="titulo" id="title" autocomplete="off"><br><br>
        
                <label class="form-label" for="content">Conteúdo:</label><br>
                <textarea name="conteudo"  id="content"> <?= $row["conteudo"] ?></textarea><br><br>
        
                <label class="form-label" for="category">Categoria:</label><br>
                
                <!-- <input class="form-control" type="text" name="categoria" id="category"><br><br> -->
                <select name="id_categoria" class="form-select mb-4" id="categoria">
                    <option>Selecione uma catégoria primeiro</option>
                    <?php 
                    
                    $queryCat = "SELECT * FROM categoria";
                    $result = $conn->query($queryCat);

                    while ($row2 = $result->fetch_assoc()): ?>
                        <option  value="<?= $row2["id_categoria"]; ?>"><?= $row2["categorias"]; ?></option>
                    <?php endwhile; ?>
                </select>

                <div class="container_subcategorias">
                    <label for="subcategoria" class="form-label mb-4">Subcategoria:</label>
                    <select id="subcategorias" name="id_subcategorias" class="form-select mb-4">
                        <option>Selecione uma categoria primeiro</option>
                    </select>
                </div>
        
                <label class="form-label" for="tags">Tags:</label><br>

                <select name="tags" class="form-select mb-4">
                    <?php while ($row = $resultQuerySelectTags->fetch_assoc()): ?>
                        <option value="<?= $row["id_tags"];?>">
                            <?= $row["tags"]; ?>
                        </option>
                    <?php endwhile; ?>
                </select>


                <label class="form-label" for="image">Imagem:</label><br>
                <input multiple name="files[]" type="file" class="form-control imageInput" id="image"><br>
                <!-- accept="image/*" -->
        
                <img id="imagePreview" alt="Pré-visualização da imagem"><br><br>
                <button type="submit" class="btn btn-primary">Atualizar Postagem</button>
            <?php endwhile; ?>
        </form>
    </main>
</body>
</html>
