<?php
session_start();

if (!isset($_SESSION['cartasOriginal'])) {
    $_SESSION['cartasOriginal'] = [
        "Ás de Espadas", "2 de Espadas", "3 de Espadas", "4 de Espadas", "5 de Espadas", 
        "6 de Espadas", "7 de Espadas", "8 de Espadas", "9 de Espadas", "10 de Espadas",
        "Valete de Espadas", "Dama de Espadas", "Rei de Espadas",
        "Ás de Copas", "2 de Copas", "3 de Copas", "4 de Copas", "5 de Copas",
        "6 de Copas", "7 de Copas", "8 de Copas", "9 de Copas", "10 de Copas",
        "Valete de Copas", "Dama de Copas", "Rei de Copas",
        "Ás de Ouros", "2 de Ouros", "3 de Ouros", "4 de Ouros", "5 de Ouros",
        "6 de Ouros", "7 de Ouros", "8 de Ouros", "9 de Ouros", "10 de Ouros",
        "Valete de Ouros", "Dama de Ouros", "Rei de Ouros",
        "Ás de Paus", "2 de Paus", "3 de Paus", "4 de Paus", "5 de Paus",
        "6 de Paus", "7 de Paus", "8 de Paus", "9 de Paus", "10 de Paus",
        "Valete de Paus", "Dama de Paus", "Rei de Paus"
    ];
}

if (!isset($_SESSION['cartasEmbaralhadas'])) {
    $_SESSION['cartasEmbaralhadas'] = $_SESSION['cartasOriginal'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['embaralhar'])) {
    shuffle($_SESSION['cartasEmbaralhadas']);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo de Cartas Digital</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Embaralhar baralho</h1>

        <form method="POST" class="formulario">
            <input type="submit" name="embaralhar" value="Embaralhar Baralho">
        </form>

        <h2>Baralho antes de embaralhar:</h2>
        <ul class="baralho">
            <?php foreach ($_SESSION['cartasOriginal'] as $carta): ?>
                <li><?php echo $carta; ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Baralho embaralhado:</h2>
        <ul class="baralho">
            <?php foreach ($_SESSION['cartasEmbaralhadas'] as $carta): ?>
                <li><?php echo $carta; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>