<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<?php
// Inclua o arquivo de configuração
include 'config.php';

// Variável para armazenar se o cadastro foi concluído com sucesso
$cadastroSucesso = false;

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $curso = htmlspecialchars($_POST['curso']);

    // Preparar a query usando um statement
    $stmt = $conn->prepare("INSERT INTO alunos (nome, email, curso) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $curso);

    if ($stmt->execute()) {
        $cadastroSucesso = true;
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>

    <h2 style="text-align: center;">Cadastro de Alunos</h2>
    <form id="cadastroForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validarForm()">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="curso">Curso:</label>
        <select id="curso" name="curso" required>
            <option value="">Selecione o curso</option>
			<option value="ADS">Análise e Desenvolvimento de Sistemas</option>
			<option value="Administração">Administração</option>
            <option value="Engenharia Civil">Engenharia Civil</option>            
            <option value="Direito">Direito</option>
			<option value="Medicina">Medicina</option>
            
        </select>
        
        <input type="submit" value="Cadastrar">
    </form>

    <?php if ($cadastroSucesso): ?>
    <div id="popupCadastro" class="popup" style="display:block;">
        <p>Cadastro concluído com sucesso!</p>
        <button onclick="fecharPopup()">Fechar</button>
    </div>
    <?php endif; ?>

    <div class="button-container" style="text-align: center; margin-top: 20px;">
        <a href="alunoscadastrados.php">Consulta a Alunos</a>
    </div>

    <script>
        function validarForm() {
            var nome = document.getElementById('nome').value.trim();
            var email = document.getElementById('email').value.trim();
            var curso = document.getElementById('curso').value;

            if (nome === '' || email === '' || curso === '') {
                alert('Por favor, preencha todos os campos.');
                return false; // Impede o envio do formulário se algum campo estiver vazio
            }

            // Permite o envio do formulário
            return true;
        }

        function fecharPopup() {
            var popup = document.getElementById('popupCadastro');
            popup.style.display = 'none';
            // Redireciona para a mesma página após fechar o popup
            window.location.href = '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>';
        }
    </script>
</body>
</html>
