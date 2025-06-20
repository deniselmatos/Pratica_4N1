<?php
session_start();

if (!isset($_SESSION['idsFonteA'])) {
    $_SESSION['idsFonteA'] = [101, 105, 102];
}

if (!isset($_SESSION['idsFonteB'])) {
    $_SESSION['idsFonteB'] = [103, 101, 106];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addFonteA'])) {
    $id = $_POST['idFonteA'];
    if (!empty($id) && !in_array($id, $_SESSION['idsFonteA'])) {
        $_SESSION['idsFonteA'][] = $id;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addFonteB'])) {
    $id = $_POST['idFonteB'];
    if (!empty($id) && !in_array($id, $_SESSION['idsFonteB'])) {
        $_SESSION['idsFonteB'][] = $id;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['removeFonteA'])) {
    $id = $_POST['idFonteA'];
    if (($key = array_search($id, $_SESSION['idsFonteA'])) !== false) {
        unset($_SESSION['idsFonteA'][$key]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['removeFonteB'])) {
    $id = $_POST['idFonteB'];
    if (($key = array_search($id, $_SESSION['idsFonteB'])) !== false) {
        unset($_SESSION['idsFonteB'][$key]);
    }
}

$todosIds = array_unique(array_merge($_SESSION['idsFonteA'], $_SESSION['idsFonteB']));
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consolidação de IDs de Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Consolidação de IDs de usuários</h1>
        
        <form method="POST" class="formulario">
            <label for="idFonteA">Adicionar ID na Fonte A:</label>
            <input type="number" id="idFonteA" name="idFonteA" required>
            <input type="submit" name="addFonteA" value="Adicionar à Fonte A">
        </form>

        <form method="POST" class="formulario">
            <label for="idFonteB">Adicionar ID na Fonte B:</label>
            <input type="number" id="idFonteB" name="idFonteB" required>
            <input type="submit" name="addFonteB" value="Adicionar à Fonte B">
        </form>

        <form method="POST" class="formulario">
            <label for="idFonteA">Remover ID da Fonte A:</label>
            <input type="number" id="idFonteA" name="idFonteA" required>
            <input type="submit" name="removeFonteA" value="Remover da Fonte A">
        </form>

        <form method="POST" class="formulario">
            <label for="idFonteB">Remover ID da Fonte B:</label>
            <input type="number" id="idFonteB" name="idFonteB" required>
            <input type="submit" name="removeFonteB" value="Remover da Fonte B">
        </form>

        <h2>Fonte A:</h2>
        <ul class="lista-ids">
            <?php foreach ($_SESSION['idsFonteA'] as $id): ?>
                <li><?php echo $id; ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Fonte B:</h2>
        <ul class="lista-ids">
            <?php foreach ($_SESSION['idsFonteB'] as $id): ?>
                <li><?php echo $id; ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Todos os IDs sem duplicatas:</h2>
        <ul class="lista-ids">
            <?php foreach ($todosIds as $id): ?>
                <li><?php echo $id; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>