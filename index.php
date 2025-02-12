<?php
session_start();
?>

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

               if($result->num_rows == 0) {
                    echo "<span style='text-align: center; margin-top: 350px;'>Não Existe nenhum Artigo criado no momento</span>";
                    die;
                }
                
                while ($row = $result->fetch_assoc()):
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        <img src="<?= explode(',', $row["image"])[0] ?>" class="card-img-top" alt="Imagem do artigo">
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

    <?php if (isset($_SESSION['mensagem'])): ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                Swal.fire({
                    icon: '<?= $_SESSION['mensagem']['tipo'] ?>', // success, error, warning, info
                    title: '<?= ($_SESSION['mensagem']['tipo'] == 'success') ? 'Sucesso!' : 'Erro!' ?>',
                    text: '<?= $_SESSION['mensagem']['texto'] ?>',
                    timer: 3000, // Fecha automaticamente em 3 segundos
                    showConfirmButton: true
                });
            });
        </script>
        <?php unset($_SESSION['mensagem']); // Limpa a sessão após exibir a mensagem ?>
    <?php endif; ?>

</body>
</html>
