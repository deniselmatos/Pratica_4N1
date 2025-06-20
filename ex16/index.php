<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $caracteresPermitidos = $_POST['caracteres'];
    $stringCaracteres = implode('', str_split($caracteresPermitidos)); 

    function gerarSenha($tamanho, $caracteres) {
        $senha = '';
        $comprimento = strlen($caracteres);
        for ($i = 0; $i < $tamanho; $i++) {
            $senha .= $caracteres[random_int(0, $comprimento - 1)];
        }
        return $senha;
    }

    $senhaGerada = gerarSenha(8, $stringCaracteres);
} else {
    $caracteresPermitidos = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%';
    $stringCaracteres = implode('', str_split($caracteresPermitidos));
    $senhaGerada = '';
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de senhas</title>
</head>
<body>
    <div class="container">
        <h1>Gerador de senhas</h1>

        <form method="POST" action="">
            <label for="caracteres">Digite os caracteres permitidos (sem separadores):</label><br>
            <input type="text" name="caracteres" id="caracteres" value="<?php echo htmlspecialchars($caracteresPermitidos); ?>" required><br><br>

            <button type="submit">Gerar senha</button>
        </form>

        <h2>Caractéres Permitidos (String Concatenada):</h2>
        <p><?php echo $stringCaracteres; ?></p>

        <h2>Senha Gerada:</h2>
        <p><strong><?php echo $senhaGerada; ?></strong></p>
    </div>
</body>
</html>