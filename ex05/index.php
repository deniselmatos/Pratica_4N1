<?php
session_start();

if (!isset($_SESSION['especiesObservadas'])) {
    $_SESSION['especiesObservadas'] = ['Beija-flor', 'Canário', 'Bem-te-vi', 'Sabiá', 'Beija-flor', 'Coruja'];
}

function verificarPardal($especies) {
    return in_array('Pardal', $especies);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['especieNovo'])) {
    $especieNovo = $_POST['especieNovo'];
    if (!empty($especieNovo) && !in_array($especieNovo, $_SESSION['especiesObservadas'])) {
        $_SESSION['especiesObservadas'][] = $especieNovo;  
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['especieRemover'])) {
    $especieRemover = $_POST['especieRemover'];
    if (($key = array_search($especieRemover, $_SESSION['especiesObservadas'])) !== false) {
        unset($_SESSION['especiesObservadas'][$key]);  
        $_SESSION['especiesObservadas'] = array_values($_SESSION['especiesObservadas']); 
    }
}

$especiesUnicas = array_unique($_SESSION['especiesObservadas']);

$pardalPresente = verificarPardal($_SESSION['especiesObservadas']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoramento Ambiental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Monitoramento Ambiental</h1>

        <p><strong>O Pardal já foi registrado?</strong> 
            <?php echo $pardalPresente ? 'Sim' : 'Não'; ?>
        </p>

        <form method="POST" class="formulario">
            <label for="especieNovo">Adicionar:</label>
            <input type="text" id="especieNovo" name="especieNovo" required>
            <input type="submit" value="Adicionar">
        </form>

        <form method="POST" class="formulario">
            <label for="especieRemover">Remover:</label>
            <select name="especieRemover" required>
                <?php foreach ($_SESSION['especiesObservadas'] as $especie): ?>
                    <option value="<?php echo $especie; ?>"><?php echo $especie; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Remover">
        </form>

        <h2>Espécies Registradas:</h2>
        <ul>
            <?php foreach ($especiesUnicas as $especie): ?>
                <li><?php echo $especie; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>