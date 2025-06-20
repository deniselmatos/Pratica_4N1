<?php
session_start();

if (!isset($_SESSION['registrosTreino'])) {
    $_SESSION['registrosTreino'] = [
        ["nome" => "Natália", "treinos" => [40, 50, 65]],
        ["nome" => "Pedro", "treinos" => [58, 55, 70]],
        ["nome" => "Deisy", "treinos" => [38, 45, 60]]
    ];
}

function calcularMedia($treinos) {
    return array_sum($treinos) / count($treinos);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nomeAluno = $_POST['nomeAluno'];
    $treinos = explode(",", $_POST['treinos']); 
    $treinos = array_map('floatval', $treinos);
    
    $novoAluno = ["nome" => $nomeAluno, "treinos" => $treinos];
    $_SESSION['registrosTreino'][] = $novoAluno;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Treino de Academia</title>
</head>
<body>
    <div class="container">
        <h1>Registros de Treino de Academia</h1>

        <h2>Adicionar Novo Aluno</h2>
        <form method="POST" action="">
            <label for="nomeAluno">Nome do Aluno:</label>
            <input type="text" name="nomeAluno" id="nomeAluno" required><br><br>

            <label for="treinos">Resultados dos Treinos (separados por vírgula):</label>
            <input type="text" name="treinos" id="treinos" placeholder="Ex: 40,50,60" required><br><br>

            <button type="submit">Adicionar aluno</button>
        </form>

        <h2>Registros de treino dos alunos:</h2>
        <ul class="lista-alunos">
            <?php foreach ($_SESSION['registrosTreino'] as $aluno): ?>
                <li>
                    <strong><?php echo $aluno['nome']; ?></strong> - Média: <?php echo number_format(calcularMedia($aluno['treinos']), 2, ',', '.'); ?><br>
                    Resultados dos Treinos:
                    <ul>
                        <?php foreach ($aluno['treinos'] as $treino): ?>
                            <li><?php echo $treino; ?> kg</li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>