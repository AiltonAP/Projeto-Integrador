<?php
// Conexão com o banco de dados
require("conecta.php");

// Verifica se o ID foi enviado pelo formulário
if (isset($_POST['id_dev'])) {
    $id_dev = $_POST['id_dev'];

    // Consulta para obter os dados do profissional pelo ID
    $sql = "SELECT * FROM DEV WHERE id_dev = '$id_dev'";
    $resultado = mysqli_query($conn, $sql);

    // Verifica se o ID existe no banco de dados
    if (mysqli_num_rows($resultado) > 0) {
        $dado = mysqli_fetch_assoc($resultado);
    } else {
        echo "Profissional não encontrado.";
        exit;
    }
}

// Se o formulário foi enviado para atualizar os dados
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'])) {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $genero = $_POST['genero'];
    $estado_civil = $_POST['estado_civil'];
    $idiomas = isset($_POST['idiomas']) ? implode(', ', $_POST['idiomas']) : '';
    $experiencia = $_POST['experiencia'];

    // Atualiza os dados no banco de dados
    $update_sql = "UPDATE DEV SET
                   NOME = '$nome', 
                   SOBRENOME = '$sobrenome', 
                   EMAIL = '$email', 
                   GÊNERO = '$genero', 
                   `ESTADO CIVIL` = '$estado_civil', 
                   IDIOMAS = '$idiomas', 
                   EXPERIENCIA = '$experiencia'
                   WHERE id_dev = '$id_dev'";

    if (mysqli_query($conn, $update_sql)) {
        echo "<h2>Cadastro atualizado com sucesso!</h2>";
        echo '<a href="index.html" class="button">Voltar para a página inicial</a>';
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conn);
    }

    // Fecha a conexão após a atualização
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
    <title>Alterar Profissional</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .formulario {
            margin: 20px auto;
            width: 60%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .campo {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 10px;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Alterar Dados do Profissional</h1>

    <!-- Formulário para buscar o ID do profissional -->
    <div class="formulario">
        <form method="POST" action="">
            <div class="campo">
                <label for="id_dev">Informe o ID do Profissional</label>
                <input type="number" id="id_dev" name="id_dev" required>
            </div>
            <button type="submit">Buscar Profissional</button>
        </form>
    </div>

    <?php if (isset($dado)) { ?>
        <!-- Formulário para editar os dados do profissional -->
        <div class="formulario">
            <form method="POST" action="">
                <input type="hidden" name="id_dev" value="<?= $dado['id_dev'] ?>">

                <!-- Campo Nome -->
                <div class="campo">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" value="<?= $dado['NOME'] ?>" required>
                </div>

                <!-- Campo Sobrenome -->
                <div class="campo">
                    <label for="sobrenome">Sobrenome</label>
                    <input type="text" id="sobrenome" name="sobrenome" value="<?= $dado['SOBRENOME'] ?>" required>
                </div>

                <!-- Campo Email -->
                <div class="campo">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= $dado['EMAIL'] ?>" required>
                </div>

                <!-- Campo Gênero -->
                <div class="campo">
                    <label>Gênero</label>
                    <label>
                        <input type="radio" name="genero" value="masculino" <?= $dado['GÊNERO'] == 'masculino' ? 'checked' : '' ?>> Masculino
                    </label>
                    <label>
                        <input type="radio" name="genero" value="feminino" <?= $dado['GÊNERO'] == 'feminino' ? 'checked' : '' ?>> Feminino
                    </label>
                    <label>
                        <input type="radio" name="genero" value="outro" <?= $dado['GÊNERO'] == 'outro' ? 'checked' : '' ?>> Outro
                    </label>
                </div>

                <!-- Campo Estado Civil -->
                <div class="campo">
                    <label for="estado_civil">Estado Civil</label>
                    <select id="estado_civil" name="estado_civil" required>
                        <option value="solteiro(a)" <?= $dado['ESTADO CIVIL'] == 'solteiro(a)' ? 'selected' : '' ?>>Solteiro(a)</option>
                        <option value="casado(a)" <?= $dado['ESTADO CIVIL'] == 'casado(a)' ? 'selected' : '' ?>>Casado(a)</option>
                        <option value="viúvo(a)" <?= $dado['ESTADO CIVIL'] == 'viúvo(a)' ? 'selected' : '' ?>>Viúvo(a)</option>
                    </select>
                </div>

                <!-- Campo Idiomas -->
                <div class="campo">
                    <label>Idiomas</label><br>
                    <input type="checkbox" name="idiomas[]" value="Inglês" <?= strpos($dado['IDIOMAS'], 'Inglês') !== false ? 'checked' : '' ?>> Inglês
                    <input type="checkbox" name="idiomas[]" value="Espanhol" <?= strpos($dado['IDIOMAS'], 'Espanhol') !== false ? 'checked' : '' ?>> Espanhol
                    <input type="checkbox" name="idiomas[]" value="Francês" <?= strpos($dado['IDIOMAS'], 'Francês') !== false ? 'checked' : '' ?>> Francês
                    <input type="checkbox" name="idiomas[]" value="Alemão" <?= strpos($dado['IDIOMAS'], 'Alemão') !== false ? 'checked' : '' ?>> Alemão
                    <input type="checkbox" name="idiomas[]" value="Português" <?= strpos($dado['IDIOMAS'], 'Português') !== false ? 'checked' : '' ?>> Português
                </div>

                <!-- Campo Experiência -->
                <div class="campo">
                    <label for="experiencia">Experiência Profissional</label>
                    <textarea name="experiencia" id="experiencia" rows="5" required><?= $dado['EXPERIENCIA'] ?></textarea>
                </div>

                <!-- Botão de enviar -->
                <button type="submit">Atualizar Dados</button>
            </form>
        </div>
    <?php } ?>

</body>
</html>
