<?php

// Função apenas para debug do codígo

function dd($params) {
    echo "<pre>";
    print_r($params);
    echo "</pre>";
}

// Conexão

$HOST = "192.168.0.104";
$USER = "almeidaadev";
$PASS = "@Senha:0147895623";
$DBSO = "artigos";

try {
    $conn = new mysqli($HOST, $USER, $PASS, $DBSO);

    if ($conn->connect_error) {
        die("Err " . $conn->connect_error);
    }
} catch (PDOException $e) {
    die("Err: " . $e);
}