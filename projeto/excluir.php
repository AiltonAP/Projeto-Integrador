<?php
// Inclui o arquivo de conexão com o banco de dados
require("conecta.php");

$dado = null;

// Verifica se o ID foi enviado pelo formulário para buscar os dados
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_dev']) && !isset($_POST['confirmar'])) {
    $id_dev = $_POST['id_dev'];

    // Consulta para obter os dados do registro
    $sql = "SELECT * FROM dev WHERE id_dev = '$id_dev'";
    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $dado = mysqli_fetch_assoc($resultado);
    } else {
        echo "<h2>Registro não encontrado.</h2>";
        mysqli_close($conn);
        exit;
    }
}

// Verifica se o ID foi enviado para confirmação da exclusão
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_dev'], $_POST['confirmar'])) {
    $id_dev = $_POST['id_dev'];

    // Executa a exclusão do registro
    $delete_sql = "DELETE FROM dev WHERE id_dev = '$id_dev'";
    if (mysqli_query($conn, $delete_sql)) {
        echo "<h2 style='color: green;'>Registro excluído com sucesso!</h2>";
    } else {
        echo "Erro ao excluir: " . mysqli_error($conn);
    }

    // Fecha a conexão com o banco e encerra
    mysqli_close($conn);
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Profissional</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        .formulario {
            margin: 20px auto;
            width: 50%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #e8f5e9;
        }
        label, input, button {
            display: block;
            width: 100%;
            margin: 10px 0;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #a5d6a7;
        }
    </style>
</head>
<body>
    <h1>Excluir Profissional</h1>
    
    <?php if (!$dado) { ?>
        <!-- Formulário para buscar o registro -->
        <div class="formulario">
            <form method="POST" action="">
                <label for="id_dev">Informe o ID do Profissional</label>
                <input type="number" id="id_dev" name="id_dev" required>
                <button type="submit">Buscar</button>
            </form>
        </div>
    <?php } ?>

    <?php if ($dado) { ?>
        <!-- Exibição dos dados do registro e confirmação -->
        <h2>Dados do Registro</h2>
        <table>
            <tr><th>ID</th><td><?= htmlspecialchars($dado['id_dev']) ?></td></tr>
            <tr><th>Nome</th><td><?= htmlspecialchars($dado['NOME']) ?></td></tr>
            <tr><th>Sobrenome</th><td><?= htmlspecialchars($dado['SOBRENOME']) ?></td></tr>
            <tr><th>Email</th><td><?= htmlspecialchars($dado['EMAIL']) ?></td></tr>
            <tr><th>Gênero</th><td><?= htmlspecialchars($dado['GÊNERO']) ?></td></tr>
            <tr><th>Estado Civil</th><td><?= htmlspecialchars($dado['ESTADO CIVIL']) ?></td></tr>
            <tr><th>Idiomas</th><td><?= htmlspecialchars($dado['IDIOMAS']) ?></td></tr>
            <tr><th>Experiência</th><td><?= htmlspecialchars($dado['EXPERIENCIA']) ?></td></tr>
        </table>
        <div class="formulario">
            <form method="POST" action="">
                <input type="hidden" name="id_dev" value="<?= $dado['id_dev'] ?>">
                <p style="color: red;">Tem certeza de que deseja excluir este registro?</p>
                <button type="submit" name="confirmar" value="true">Confirmar Exclusão</button>
                <button type="button" onclick="window.location.href='excluir.php'">Cancelar</button>
            </form>
        </div>
    <?php } ?>
</body>
</html>
