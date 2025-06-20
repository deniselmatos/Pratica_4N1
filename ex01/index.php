<?php
session_start();

if (!isset($_SESSION['produtos'])) {
    $_SESSION['produtos'] = [];
}

if (isset($_GET['remover'])) {
    $index_produto = $_GET['remover'];

    array_splice($_SESSION['produtos'], $index_produto, 1);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>CGerenciamento de Produtos</h1>

        <form action="cadastrar_produtos.php" method="POST" class="form-cadastro">
            <label for="nome_produto">Nome do Produto:</label>
            <input type="text" id="nome_produto" name="nome_produto" required><br><br>

            <label for="codigo_sku">Código SKU:</label>
            <input type="text" id="codigo_sku" name="codigo_sku" required><br><br>

            <input type="submit" value="Cadastrar Produto">
        </form>

        <hr>

        <h2>Produtos Cadastrados</h2>
        <ul class="lista-produtos">
            <?php
            if (isset($_SESSION['produtos']) && !empty($_SESSION['produtos'])) {
                foreach ($_SESSION['produtos'] as $index => $produto) {
                    echo "<li>Produto: {$produto['nome']} - SKU: {$produto['sku']} 
                          <a href='?remover=$index' class='remover'>[Remover]</a></li>";
                }
            } else {
                echo "<li>Nenhum produto cadastrado.</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>