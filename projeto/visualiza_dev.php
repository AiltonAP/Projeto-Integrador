<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de Profissionais</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        table {
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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
    <h1>Profissionais Cadastrados</h1>

    <table>
        <tr>
            <th>NOME</th>
            <th>SOBRENOME</th>
            <th>EMAIL</th>
        </tr>

        <?php
            // Conexão com o banco de dados
            require("conecta.php");

            // Consulta aos dados dos profissionais cadastrados
            $dados_select = mysqli_query($conn, "SELECT NOME, SOBRENOME, EMAIL FROM DEV");

            // Exibe os dados na tabela
            while($dado = mysqli_fetch_assoc($dados_select)) {
                echo '<tr>';
                echo '<td>' . $dado['NOME'] . '</td>';
                echo '<td>' . $dado['SOBRENOME'] . '</td>';
                echo '<td>' . $dado['EMAIL'] . '</td>';
                echo '</tr>';
            }
        ?>
    </table>

    <a href="index.html" class="button">Voltar para a página inicial</a>

</body>

</html>
