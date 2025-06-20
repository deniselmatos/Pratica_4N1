<?php
session_start();

if (!isset($_SESSION['listaParticipantes'])) {
    $_SESSION['listaParticipantes'] = ['Carlos', 'Ana', 'João', 'Maria', 'João', 'Pedro', 'Maria', 'Ana'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addParticipante'])) {
    $novoParticipante = trim($_POST['participante']);
    if (!empty($novoParticipante) && !in_array($novoParticipante, $_SESSION['listaParticipantes'])) {
        $_SESSION['listaParticipantes'][] = $novoParticipante;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['removeParticipante'])) {
    $participanteRemover = trim($_POST['participante']);
    if (($key = array_search($participanteRemover, $_SESSION['listaParticipantes'])) !== false) {
        unset($_SESSION['listaParticipantes'][$key]);
    }
}

$participantesUnicos = array_unique($_SESSION['listaParticipantes']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Presenças em Eventos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Registro de Presenças em Eventos</h1>
        
        <form method="POST" class="formulario">
            <label for="participante">Adicionar Participante:</label>
            <input type="text" id="participante" name="participante" required>
            <input type="submit" name="addParticipante" value="Adicionar">
        </form>

        <form method="POST" class="formulario">
            <label for="participante">Remover Participante:</label>
            <input type="text" id="participante" name="participante" required>
            <input type="submit" name="removeParticipante" value="Remover">
        </form>

        <h2>Lista de participantes sem duplicatas:</h2>
        <ul class="lista-participantes">
            <?php foreach ($participantesUnicos as $participante): ?>
                <li><?php echo $participante; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>