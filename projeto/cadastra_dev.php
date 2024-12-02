<?php
// Configuração do banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'projeto';

// Conexão com o banco de dados
$conn = new mysqli($host, $user, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Configura o charset para UTF-8
$conn->set_charset("utf8");

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura e sanitiza os dados do formulário
    $nome = isset($_POST['nome']) ? $conn->real_escape_string(trim($_POST['nome'])) : '';
    $sobrenome = isset($_POST['sobrenome']) ? $conn->real_escape_string(trim($_POST['sobrenome'])) : '';
    $email = isset($_POST['email']) ? $conn->real_escape_string(trim($_POST['email'])) : '';
    $genero = isset($_POST['genero']) ? $conn->real_escape_string(trim($_POST['genero'])) : '';
    $estado_civil = isset($_POST['estado_civil']) ? $conn->real_escape_string(trim($_POST['estado_civil'])) : '';
    $idiomas = isset($_POST['idiomas']) ? implode(', ', array_map([$conn, 'real_escape_string'], $_POST['idiomas'])) : '';
    $experiencia = isset($_POST['experiencia']) ? $conn->real_escape_string(trim($_POST['experiencia'])) : '';

    // Valida os campos obrigatórios
    if (empty($nome) || empty($sobrenome) || empty($email) || empty($genero) || empty($estado_civil)) {
        $message = "<p style='color: red;'>Por favor, preencha todos os campos obrigatórios!</p>";
    } else {
        // Prepara a query de inserção
        $sql = "
            INSERT INTO dev (NOME, SOBRENOME, EMAIL, `GÊNERO`, `ESTADO CIVIL`, IDIOMAS, EXPERIENCIA)
            VALUES ('$nome', '$sobrenome', '$email', '$genero', '$estado_civil', '$idiomas', '$experiencia')
        ";

        // Executa a query e verifica o resultado
        if ($conn->query($sql) === TRUE) {
            $message = "<p style='color: green;'>Cadastro realizado com sucesso!</p>";
        } else {
            $message = "<p style='color: red;'>Erro ao cadastrar: " . $conn->error . "</p>";
        }
    }
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Profissionais</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f9;
        }

        .form-container {
            background-color: #fff;
            padding: 20px 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .campo {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input, select, textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .radio-group {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .checkbox-group label {
            display: block;
            width: auto;
        }

        .message {
            text-align: center;
            padding: 10px;
            font-weight: bold;
        }

        .message.success {
            color: #4CAF50;
        }

        .message.error {
            color: #F44336;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Cadastro de Desenvolvedores</h1>

    <form method="POST" action="cadastra_dev.php">
        <div class="campo">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
        </div>

        <div class="campo">
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" name="sobrenome" id="sobrenome" required>
        </div>

        <div class="campo">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="campo">
            <label><strong>Gênero</strong></label>
            <div class="radio-group">
                <label><input type="radio" name="genero" value="Masculino" checked> Masculino</label>
                <label><input type="radio" name="genero" value="Feminino"> Feminino</label>
                <label><input type="radio" name="genero" value="Outro"> Outro</label>
            </div>
        </div>

        <div class="campo">
            <label for="estado_civil"><strong>Estado Civil</strong></label>
            <select name="estado_civil" id="estado_civil" required>
                <option value="" disabled selected>Selecione</option>
                <option value="Solteiro">Solteiro(a)</option>
                <option value="Casado">Casado(a)</option>
                <option value="Viúvo">Viúvo(a)</option>
            </select>
        </div>

        <div class="campo">
            <label><strong>Idiomas</strong></label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="idiomas[]" value="Inglês"> Inglês</label>
                <label><input type="checkbox" name="idiomas[]" value="Espanhol"> Espanhol</label>
                <label><input type="checkbox" name="idiomas[]" value="Francês"> Francês</label>
                <label><input type="checkbox" name="idiomas[]" value="Alemão"> Alemão</label>
                <label><input type="checkbox" name="idiomas[]" value="Português" checked> Português</label>
            </div>
        </div>

        <div class="campo">
            <label for="experiencia"><strong>Resumo da sua experiência profissional: </strong></label>
            <textarea name="experiencia" id="experiencia" rows="6"></textarea>
        </div>

        <button type="submit">Finalizar Cadastro</button>
    </form>

    <!-- Exibe mensagens de sucesso ou erro -->
    <?php
    if (isset($message)) {
        echo "<div class='message " . (strpos($message, 'erro') === false ? 'success' : 'error') . "'>$message</div>";
    }
    ?>
</div>

</body>
</html>
