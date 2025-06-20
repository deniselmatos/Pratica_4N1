<?php
session_start();

if (!isset($_SESSION['produtos'])) {
    $_SESSION['produtos'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_produto = $_POST['nome_produto'];
    $codigo_sku = $_POST['codigo_sku'];

    $novo_produto = [
        'nome' => $nome_produto,
        'sku' => $codigo_sku
    ];

    $_SESSION['produtos'][] = $novo_produto;

    header("Location: index.php");
    exit;
}

