<?php
session_start();

if (!isset($_SESSION['livros'])) {
    $_SESSION['livros'] = ['Memórias Póstumas de Brás Cubas', 'Noites Brancas', 'Jogos Vorazes', 'Diários de uma Apotecária', 'Vidas Secas'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['livro_novo'])) {
    $livro_novo = $_POST['livro_novo'];
    if (!empty($livro_novo)) {
        $_SESSION['livros'][] = $livro_novo;  
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['livro_remover'])) {
    $livro_remover = $_POST['livro_remover'];
    if (($key = array_search($livro_remover, $_SESSION['livros'])) !== false) {
        unset($_SESSION['livros'][$key]); 
        $_SESSION['livros'] = array_values($_SESSION['livros']);  
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Estoque de Livros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Gestão de Estoque de Livros</h1>

        <form method="POST" class="formulario">
            <label for="livro_novo">Novo livro:</label>
            <input type="text" id="livro_novo" name="livro_novo" required>
            <input type="submit" value="Adicionar">
        </form>

        <form method="POST" class="formulario">
            <label for="livro_remover">Escolha um livro para remover:</label>
            <select name="livro_remover" required>
                <?php foreach ($_SESSION['livros'] as $livro): ?>
                    <option value="<?php echo $livro; ?>"><?php echo $livro; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Remover">
        </form>

        <h2>Estoque atual:</h2>
        <ul class="estoque">
            <?php foreach ($_SESSION['livros'] as $livro): ?>
                <li><?php echo $livro; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>