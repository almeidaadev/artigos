<?php
require './Database/Connection/Connection.php';

if (isset($_GET['id_categoria'])) {
    $idCategoria = (int) $_GET['id_categoria'] ?? 1;  

    $query = "SELECT * FROM subcategorias WHERE id_subcategorias = $idCategoria";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id_subcategorias']}'>{$row['subcategorias']}</option>";
        }
    } else {
        echo "<option value=''>Nenhuma subcategoria encontrada</option>";
    }
} else {
    echo "<option value=''>Selecione uma categoria primeiro</option>";
}