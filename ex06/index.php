<?php
session_start();

if (!isset($_SESSION['categoriasProdutos'])) {
    $_SESSION['categoriasProdutos'] = ["Livros", "Eletrônicos", "Roupas", "Jogos e Brinquedos", "Maquiagem e Skin Care"];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoriaNovo'])) {
    $categoriaNovo = $_POST['categoriaNovo'];
    if (!empty($categoriaNovo) && !in_array($categoriaNovo, $_SESSION['categoriasProdutos'])) {
        $_SESSION['categoriasProdutos'][] = $categoriaNovo;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoriaRemover'])) {
    $categoriaRemover = $_POST['categoriaRemover'];
    if (($key = array_search($categoriaRemover, $_SESSION['categoriasProdutos'])) !== false) {
        unset($_SESSION['categoriasProdutos'][$key]);
        $_SESSION['categoriasProdutos'] = array_values($_SESSION['categoriasProdutos']); // Reorganiza os índices
    }
}

$categoriasCrescente = $_SESSION['categoriasProdutos'];
sort($categoriasCrescente);

$categoriasDecrescente = $_SESSION['categoriasProdutos'];
rsort($categoriasDecrescente);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias de produtos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Categorias de produtos</h1>

        <form method="POST" class="formulario">
            <label for="categoriaNovo">Adicionar nova categoria:</label>
            <input type="text" id="categoriaNovo" name="categoriaNovo" required>
            <input type="submit" value="Adicionar">
        </form>

        <form method="POST" class="formulario">
            <label for="categoriaRemover">Remover categoria:</label>
            <select name="categoriaRemover" required>
                <?php foreach ($_SESSION['categoriasProdutos'] as $categoria): ?>
                    <option value="<?php echo $categoria; ?>"><?php echo $categoria; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Remover">
        </form>

        <h2>Categorias em ordem alfabética crescente:</h2>
        <ul>
            <?php foreach ($categoriasCrescente as $categoria): ?>
                <li><?php echo $categoria; ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Categorias em ordem alfabética decrescente:</h2>
        <ul>
            <?php foreach ($categoriasDecrescente as $categoria): ?>
                <li><?php echo $categoria; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>