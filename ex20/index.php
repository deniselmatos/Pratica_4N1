<?php
$inventario = [
    'notebook' => 20,
    'mouse' => 50,
    'teclado' => 30
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['produto'])) {
        $produto = $_POST['produto'];
        $quantidade = $_POST['quantidade'];

        if (array_key_exists($produto, $inventario)) {
            $inventario[$produto] += $quantidade;
        } else {
            $inventario[$produto] = $quantidade;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventário</title>
</head>
<body>
    <div class="container">
        <h1>Sistema de Inventário</h1>

        <form method="POST" action="">
            <label for="produto">Nome do Produto:</label>
            <input type="text" name="produto" id="produto" required placeholder="Ex: monitor" /><br><br>

            <label for="quantidade">Quantidade:</label>
            <input type="number" name="quantidade" id="quantidade" required placeholder="Ex: 15" /><br><br>

            <button type="submit">Atualizar inventário</button>
        </form>

        <h2>Estado Atual do Inventário:</h2>
        <pre>
            <?php
                print_r($inventario);
            ?>
        </pre>
    </div>
</body>
</html>