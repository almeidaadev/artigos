<?php 

require "./Database/Connection/Connection.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    $queryDelete = "DELETE FROM art WHERE id = $id";
    $result = $conn->query($queryDelete);

    echo "Artigo Deletado";

}