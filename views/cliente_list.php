<!-- a view vai mostrar na tela o que foi acessado no banco de dados -->
<!-- vai existir a variável $clientes (criado no controlador) -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Clientes</title>
    <link rel="stylesheet" type="text/css" href="list.css">
</head>
<body>
     <h1>Listagem de Clientes</h1>
     <button><a href="views/cliente_adicionar.php">+ Adicionar Cliente</a></button>
     <br><br>

     <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>E-mail</td>
                <td>Telefone</td>
                <td>Ações</td>
            </tr>
        </thead>

        <tbody>
        <!-- Criar uma repetição para exibir todos os clientes, usando a variável $clientes -->
            <?php
                while ($cliente = $clientes->fetch(PDO::FETCH_ASSOC)):  ?>
                <tr>
                    <td><?= $cliente['id'] ?></td>
                    <td><?= htmlspecialchars($cliente['nome']) ?></td>
                    <td><?= htmlspecialchars($cliente['email']) ?></td>
                    <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                    <td>
                        <a href="cliente_index.php?acao=alterar&id=<?= $cliente['id'] ?>">Editar</a> |
                        <a href="cliente_index.php?acao=excluir&id=<?= $cliente['id'] ?>" onclick="return confirm('Confirma exclusão?')">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>