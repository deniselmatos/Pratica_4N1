<?php
session_start();

if (!isset($_SESSION['precosProdutos'])) {
    $_SESSION['precosProdutos'] = [
            "Arroz" => 24.50,
            "Feijão" => 10.40,
            "Café" => 14.0,
            "Açúcar" => 5.80,
            "Farinha" => 4.0
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produtoNovo'], $_POST['precoNovo'])) {
    $produtoNovo = $_POST['produtoNovo'];
    $precoNovo = floatval($_POST['precoNovo']);
    if (!empty($produtoNovo) && $precoNovo > 0) {
        $_SESSION['precosProdutos'][$produtoNovo] = $precoNovo;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produtoRemover'])) {
    $produtoRemover = $_POST['produtoRemover'];
    unset($_SESSION['precosProdutos'][$produtoRemover]);
}

asort($_SESSION['precosProdutos']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precificação de produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Precificação de produtos</h1>

        <form method="POST" class="formulario">
            <label for="produtoNovo">Adicionar produto:</label>
            <input type="text" id="produtoNovo" name="produtoNovo" required>
            <label for="precoNovo">Preço:</label>
            <input type="number" step="0.01" id="precoNovo" name="precoNovo" required>
            <input type="submit" value="Adicionar">
        </form>

        <form method="POST" class="formulario">
            <label for="produtoRemover">Remover produto:</label>
            <select name="produtoRemover" required>
                <?php foreach ($_SESSION['precosProdutos'] as $produto => $preco): ?>
                    <option value="<?php echo $produto; ?>"><?php echo $produto; ?> - R$ <?php echo number_format($preco, 2, ',', '.'); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Remover">
        </form>

        <h2>Produtos e os seus preços, ordenados do mais barato para o mais caro:</h2>
        <ul>
            <?php foreach ($_SESSION['precosProdutos'] as $produto => $preco): ?>
                <li><?php echo $produto; ?> - R$ <?php echo number_format($preco, 2, ',', '.'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>