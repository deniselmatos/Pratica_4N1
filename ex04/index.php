<?php
session_start();

function verificar_primo($numero) {
    if ($numero <= 1) {
        return false;
    }
    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i == 0) {
            return false;
        }
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numerosSorteados = [];
    for ($i = 0; $i < 10; $i++) {
        $numerosSorteados[] = rand(1, 60);
    }

    $numerosPrimos = 0;
    foreach ($numerosSorteados as $numero) {
        if (verificar_primo($numero)) {
            $numerosPrimos++;
        }
    }

    $_SESSION['numerosSorteados'] = $numerosSorteados;
    $_SESSION['numerosPrimos'] = $numerosPrimos;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorteio e Números Primos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Sorteio e Números Primos</h1>

        <form method="POST" class="formulario">
            <input type="submit" value="Gerar Números Sorteados">
        </form>

        <?php if (isset($_SESSION['numerosSorteados'])): ?>
            <h2>Resultado do Sorteio:</h2>
            <p><strong>Números Sorteados:</strong> <?php echo implode(', ', $_SESSION['numerosSorteados']); ?></p>
            <p><strong>Números Primos:</strong> <?php echo $_SESSION['numerosPrimos']; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>