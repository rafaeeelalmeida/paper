<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos Cadastrados</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2 style="text-align: center;">Alunos Cadastrados</h2>

    <?php
    // Inclua o arquivo de configuração
    include 'config.php';

    // Criar conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Consulta para buscar os alunos cadastrados
    $sql = "SELECT nome, email, curso, data_hora FROM alunos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<table style="width: 100%; border-collapse: collapse;">';
        echo '<thead>';
        echo '<tr>';
        echo '<th style="border: 1px solid #ddd; padding: 8px;">Nome</th>';
        echo '<th style="border: 1px solid #ddd; padding: 8px;">E-mail</th>';
        echo '<th style="border: 1px solid #ddd; padding: 8px;">Curso</th>';
        echo '<th style="border: 1px solid #ddd; padding: 8px;">Data e Hora do Cadastro</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Exibir os dados de cada linha
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($row["nome"]) . '</td>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($row["email"]) . '</td>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($row["curso"]) . '</td>';
            echo '<td style="border: 1px solid #ddd; padding: 8px;">' . htmlspecialchars($row["data_hora"]) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "<p>Nenhum aluno cadastrado.</p>";
    }

    $conn->close();
    ?>

    <div class="button-container" style="text-align: center; margin-top: 20px;">
        <a href="index.php">Novo Cadastro</a>
    </div>
</body>
</html>
