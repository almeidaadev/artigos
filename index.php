<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/style.css?v=<?= time() ?>">
</head>
<body class="bg-light">

    <?php require "./components/header.php"; ?>

    <div class="container my-5">
        <div class="row g-4">
            <?php
                require "./Database/Connection/Connection.php";

                $result = $conn->query("SELECT * FROM art");

                while ($row = $result->fetch_assoc()):
            ?>
            
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        <img src="<?= $row["image"] ?>" class="card-img-top" alt="Imagem do artigo">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="/crudArtigoss/artigoCompleto.php?id=<?= $row["id"] ?>" class="text-dark text-decoration-none">
                                    <?= $row["titulo"] ?>
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
