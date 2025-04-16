<!-- a view vai mostrar na tela o que foi acessado no banco de dados -->
<!-- vai existir a variável $clientes (criado no controlador) -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Clientes</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
     <h1>Listagem de Clientes</h1>
     <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>E-mail</td>
                <td>Telefone</td>
            </tr>
        </thead>

        <tbody>
        <!-- Criar uma repetição para exibir todos os clientes, usando a variável $clientes -->
            <?php
                while ($cliente = $clientes->fetch(PDO::FETCH_ASSOC)):
                    // $cliente recebe o fetch de $clientes linha por linha
                    echo "<tr>";
                    echo "<td>" . $cliente['id'] . "</td>";
                    echo "<td>" . $cliente['nome'] . "</td>";
                    echo "<td>" . $cliente['email'] . "</td>";
                    echo "<td>" . $cliente['telefone'] . "</td>";
                    echo "</tr>";
                endwhile;
            ?>
        </tbody>
</body>
</html>