<?php
session_start();

if (!isset($_SESSION['precosAntigos'])) {
    $_SESSION['precosAntigos'] = [15.50, 22.00, 30.75, 8.99];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionarPreco'])) {
    $novoPreco = trim($_POST['preco']);
    
    if (is_numeric($novoPreco)) {
        $_SESSION['precosAntigos'][] = (float) $novoPreco;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['removerPreco'])) {
    $precoRemover = trim($_POST['preco']);
    
    if (($key = array_search($precoRemover, $_SESSION['precosAntigos'])) !== false) {
        unset($_SESSION['precosAntigos'][$key]);
    }
    
    $_SESSION['precosAntigos'] = array_values($_SESSION['precosAntigos']);
}

$precosNovos = array_map(function($preco) {
    return $preco * 1.10;
}, $_SESSION['precosAntigos']);

if (isset($_POST['removerPreco'])) {
    $precosNovos = array_map(function($preco) {
        return $preco * 1.10;
    }, $_SESSION['precosAntigos']);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aumento de Preços</title>
</head>
<body>
    <div class="container">
        <h1>Aumento de Preços</h1>

        <form method="POST" class="formulario">
            <label for="preco">Adicionar Preço (R$):</label>
            <input type="number" step="0.01" id="preco" name="preco" required>
            <input type="submit" name="adicionarPreco" value="Adicionar">
        </form>

        <form method="POST" class="formulario">
            <label for="preco">Remover Preço (R$):</label>
            <input type="number" step="0.01" id="preco" name="preco" required>
            <input type="submit" name="removerPreco" value="Remover">
        </form>

        <h2>Preços antigos:</h2>
        <ul class="lista-precos">
            <?php foreach ($_SESSION['precosAntigos'] as $preco): ?>
                <li>R$ <?php echo number_format($preco, 2, ',', '.'); ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Preços novos, com aumento de 10%:</h2>
        <ul class="lista-precos">
            <?php foreach ($precosNovos as $preco): ?>
                <li>R$ <?php echo number_format($preco, 2, ',', '.'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>