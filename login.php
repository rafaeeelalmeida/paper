<?php
// Início da sessão
session_start();

// Verifica se o usuário já está autenticado
if (isset($_SESSION['usuario']) && isset($_SESSION['senha'])) {
    // Redireciona para a página de cadastro de alunos
    header("Location: cadastrar_alunos.php");
    exit;
}

// Variável para armazenar mensagens de erro
$mensagem_erro = '';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário (simulado)
    $usuario = htmlspecialchars($_POST['usuario']);
    $senha = htmlspecialchars($_POST['senha']);

    // Simulando autenticação (deve ser adaptado para seu sistema real)
    if ($usuario === 'admin' && $senha === 'admin') {
        // Define a sessão como autenticada
        $_SESSION['usuario'] = $usuario;
        $_SESSION['senha'] = $senha;

        // Redireciona para a página de cadastro de alunos
        header("Location: cadastrar_alunos.php");
        exit;
    } else {
        // Senha incorreta
        $mensagem_erro = "Usuário ou senha incorretos. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        
        <?php if (!empty($mensagem_erro)): ?>
            <p style="color: red;"><?php echo $mensagem_erro; ?></p>
        <?php endif; ?>
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required>
            <br><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            <br><br>
            <input type="submit" value="Entrar">
        </form>

        <br>
        <p>Se você não tem um usuário, clique abaixo para se cadastrar:</p>
        <a href="cadastro_usuario_senha.php" class="button">Cadastrar Novo Usuário</a>
    </div>
</body>
</html>
