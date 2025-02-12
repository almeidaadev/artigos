<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css?v=<?= time(); ?>">

    <title>Artigo Completo</title>
</head>
<body class="bg-light">
    <?php
        require "components/header.php";
    ?>
    <div class="container mt-5">
        <?php
        require "./Database/Connection/Connection.php";

        if (isset($_GET["id"])):
            $id = intval($_GET["id"]);
            $sql = "SELECT * FROM art WHERE id=$id";
            $result = $conn->query($sql);
        endif;
        ?>

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card shadow-lg p-4">
                <!-- Botão de edição -->
                <div class="text-end mb-4">
                    
                    <a href="/crudArtigoss/index.php" id="voltar" class="btn btn-info">Voltar</a>
                    <a id="download" href="/crudArtigoss/delete.php?id=<?= $id ?>" class="btn btn-danger">Deletar</a>
                    <a id="editar" href="./editarArtigo.php?id=<?= $row["id"]; ?>" class="btn btn-danger">✏️ Editar</a>
                </div>

                <!-- Imagem -->
                <div class="text-center">
                    <img src="<?= $row["image"] ?>" class="img-fluid rounded shadow-sm" alt="Imagem do artigo">
                </div>

                <!-- Conteúdo -->
                <div class="mt-4">
                    <h1 class="fw-bold text-primary"><?= $row["titulo"] ?></h1>
                    <p class="text-muted"><?= nl2br($row["conteudo"]) ?></p>
                </div>

                <!-- Tags, Data e Categoria -->
                <div class="mt-3">
                    <span class="badge bg-secondary">Tags: <?= $row["tags"] ?></span>
                    <br>
                    <span class="text-muted"><strong>Data:</strong> <?= date('d/m/Y', strtotime($row["dt_criada"])) ?></span>
                </div>

                <!-- Categoria -->
                <div class="mt-2">
                    <strong>Categoria:</strong>
                    <?php
                    $idCat = intval($row['id_categoria']);
                    $query = "SELECT * FROM categoria WHERE id_categoria = $idCat";
                    $resultCat = $conn->query($query);
                    while ($rowCat = $resultCat->fetch_assoc()):
                    ?>
                        <span class="badge bg-info"><?= $rowCat["categorias"] ?></span>
                    <?php endwhile; ?>
                </div>

                <!-- Subcategoria -->
                <div class="mt-2">
                    <strong>SubCategoria:</strong>
                    <?php
                    $querySubcat = "SELECT * FROM subcategorias WHERE id_subcategorias = $idCat";
                    $resultSubcat = $conn->query($querySubcat);
                    while($rowSub = $resultSubcat->fetch_assoc()):
                    ?>
                        <span class="badge bg-warning"><?= $rowSub["subcategorias"] ?></span>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
