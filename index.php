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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $curso = htmlspecialchars($_POST['curso']);

    // Aqui você pode adicionar lógica para salvar os dados em um banco de dados, por exemplo
    echo '<div id="popupCadastro" class="popup">
            <p>Cadastro concluído com sucesso!</p>
            <button onclick="fecharPopup()">Fechar</button>
          </div>';
}
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
            <option value="engenharia">Engenharia</option>
            <option value="ciencias">Ciências</option>
            <option value="artes">Artes</option>
            <option value="historia">História</option>
        </select>
        
        <input type="submit" value="Cadastrar">
    </form>

    <div class="button-container">
        <a href="#">Home</a>
        <a href="#">Novo Cadastro</a>
        <a href="#">Consulta a Alunos</a>
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

            // Exibe o popup de cadastro concluído
            exibirPopup();

            // Retorna false para evitar o envio padrão do formulário
            return false;
        }

        function exibirPopup() {
            var popup = document.getElementById('popupCadastro');
            popup.style.display = 'block';
        }

        function fecharPopup() {
            var popup = document.getElementById('popupCadastro');
            popup.style.display = 'none';
        }
    </script>
</body>
</html>
