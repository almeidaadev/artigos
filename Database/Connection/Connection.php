<?php

// try {
//     $conn = new PDO("mysql:host=localhost; db=artigos", "root", "");
// } catch (PDOException $e) {
//     die("Err: " . $e);
// }

$conn = new mysqli("192.168.0.104", "almeidaadev", "@Senha:0147895623", "artigos");

if ($conn->connect_error) {
    die("Deu merda na conn");
}

function dd($params) {
    echo "<pre>";
    print_r($params);
    echo "</pre>";
}