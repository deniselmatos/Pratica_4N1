<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $textoAnalise = $_POST['texto'];
    
    $vetorPalavras = explode(' ', $textoAnalise);
    
    $quantidadePalavras = count($vetorPalavras);
} else {
    $textoAnalise = "A programação PHP é fundamental para o desenvolvimento web";
    $vetorPalavras = explode(' ', $textoAnalise);
    $quantidadePalavras = count($vetorPalavras);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de Frases</title>
</head>
<body>
    <div class="container">
        <h1>Análise de Frases</h1>

        <form method="POST" action="">
            <label for="texto">Digite a frase:</label><br>
            <textarea name="texto" id="texto" rows="4" cols="50" required><?php echo htmlspecialchars($textoAnalise); ?></textarea><br><br>

            <button type="submit">Analisar</button>
        </form>

        <h2>Vetor de palavras:</h2>
        <pre><?php print_r($vetorPalavras); ?></pre>

        <h2>Quantidade de palavras:</h2>
        <p><strong><?php echo $quantidadePalavras; ?></strong></p>
    </div>
</body>
</html>