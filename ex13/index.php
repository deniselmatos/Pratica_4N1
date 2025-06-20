<?php
session_start();

if (!isset($_SESSION['despesasMensais'])) {
    $_SESSION['despesasMensais'] = [1200.50, 850.75, 1500.00, 920.30, 1100.20];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionarDespesa'])) {
    $novaDespesa = trim($_POST['despesa']);
    
    if (is_numeric($novaDespesa)) {
        $_SESSION['despesasMensais'][] = (float) $novaDespesa;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['removerDespesa'])) {
    $despesaRemover = trim($_POST['despesa']);
    
    if (($key = array_search($despesaRemover, $_SESSION['despesasMensais'])) !== false) {
        unset($_SESSION['despesasMensais'][$key]);
    }
    
    $_SESSION['despesasMensais'] = array_values($_SESSION['despesasMensais']);
}

$mediaDespesas = array_sum($_SESSION['despesasMensais']) / count($_SESSION['despesasMensais']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Média de Despesas Mensais</title>
</head>
<body>
    <div class="container">
        <h1>Média de Despesas Mensais</h1>

        <form method="POST" class="formulario">
            <label for="despesa">Adicionar Despesa (R$):</label>
            <input type="number" step="0.01" id="despesa" name="despesa" required>
            <input type="submit" name="adicionarDespesa" value="Adicionar">
        </form>

        <form method="POST" class="formulario">
            <label for="despesa">Remover Despesa (R$):</label>
            <input type="number" step="0.01" id="despesa" name="despesa" required>
            <input type="submit" name="removerDespesa" value="Remover">
        </form>
>
        <h2>Despesas mensais:</h2>
        <ul class="lista-despesas">
            <?php foreach ($_SESSION['despesasMensais'] as $despesa): ?>
                <li>R$ <?php echo number_format($despesa, 2, ',', '.'); ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Média das despesas:</h2>
        <p>R$ <?php echo number_format($mediaDespesas, 2, ',', '.'); ?></p>
    </div>
</body>
</html>