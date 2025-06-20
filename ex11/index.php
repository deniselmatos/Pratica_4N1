<?php
session_start();

if (!isset($_SESSION['temperaturasDiarias'])) {
    $_SESSION['temperaturasDiarias'] = [30.3, 22.1, 10.0, -2.4, 38.7, 26.9, 39.0];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionarTemperatura'])) {
    $novaTemperatura = trim($_POST['temperatura']);
    
    if (is_numeric($novaTemperatura)) {
        $_SESSION['temperaturasDiarias'][] = (float) $novaTemperatura;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['removerTemperatura'])) {
    $temperaturaRemover = trim($_POST['temperatura']);
    
    if (($key = array_search($temperaturaRemover, $_SESSION['temperaturasDiarias'])) !== false) {
        unset($_SESSION['temperaturasDiarias'][$key]);
    }
}

$_SESSION['temperaturasDiarias'] = array_values($_SESSION['temperaturasDiarias']);

$temperaturaMaxima = max($_SESSION['temperaturasDiarias']);
$temperaturaMinima = min($_SESSION['temperaturasDiarias']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoramento de Sensores</title>
</head>
<body>
    <div class="container">
        <h1>Monitoramento de Sensores</h1>
        
        <form method="POST" class="formulario">
            <label for="temperatura">Adicionar temperatura (em °C):</label>
            <input type="number" step="0.1" id="temperatura" name="temperatura" required>
            <input type="submit" name="adicionarTemperatura" value="Adicionar">
        </form>

        <form method="POST" class="formulario">
            <label for="temperatura">Remover temperatura (em °C):</label>
            <input type="number" step="0.1" id="temperatura" name="temperatura" required>
            <input type="submit" name="removerTemperatura" value="Remover">
        </form>

        <h2>Temperaturas Registradas:</h2>
        <ul class="lista-temperaturas">
            <?php foreach ($_SESSION['temperaturasDiarias'] as $temperatura): ?>
                <li><?php echo $temperatura . " °C"; ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Temperatura máxima: <?php echo $temperaturaMaxima . " °C"; ?></h2>
        <h2>Temperatura mínima: <?php echo $temperaturaMinima . " °C"; ?></h2>
    </div>
</body>
</html>