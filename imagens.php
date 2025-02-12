<?php
require "./Database/Connection/Connection.php";

$result = $conn->query("SELECT image FROM art");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css?v=<?= time() ?>">
    <title>Document</title>
</head>
<body>
   <?php require "./components/header.php" ?>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="container__images">
            <img style="max-width: 400px; max-height:400px; border-radius: 6px; margin: 10px 0 0 10px;" src="<?= $row["image"] ?>" alt="">
        </div>
    <?php endwhile; ?>
</body>
</html>