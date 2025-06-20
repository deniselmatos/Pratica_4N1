<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dadosSensor = explode(',', $_POST['leituras']);
    
    $dadosSensor = array_map('floatval', $dadosSensor);
    
    $leiturasFiltradas = array_filter($dadosSensor, function($valor) {
        return $valor > 25.0;
    });
    
    $leiturasFiltradas = array_values($leiturasFiltradas);
} else {
    $dadosSensor = [15.2, 28.9, 12.0, 35.5, 20.1, 40.0, 5.8];
    $leiturasFiltradas = array_filter($dadosSensor, function($valor) {
        return $valor > 25.0;
    });
    $leiturasFiltradas = array_values($leiturasFiltradas);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtragem de Dados de Sensor</title>
</head>
<body>
    <div class="container">
        <h1>Filtragem de Dados de Sensor</h1>

        <form method="POST" action="">
            <label for="leituras">Digite as leituras de sensor (separadas por vírgulas):</label><br>
            <input type="text" name="leituras" id="leituras" value="<?php echo implode(',', $dadosSensor); ?>" required>
            <br><br>

            <button type="submit">Filtrar leituras</button>
        </form>

        <h2>Leituras filtradas acima de 25.0:</h2>
        <pre><?php print_r($leiturasFiltradas); ?></pre>
    </div>
</body>
</html>