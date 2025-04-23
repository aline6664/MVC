<?php
    require_once "../models/Database.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="script.js"></script>
    <title>Formulário de Cadastro</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <!--<form action="processamento.php" method="POST">-->
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome"><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email"><br>

        <label for="telefone">Telefone:</label><br>
        <input type="text" id="telefone" name="telefone"><br>

        <!-- Botões -->
        <button type="submit" name="acao" value="incluir">Enviar</button>
        <button type="submit" name="acao" value="listar">Listar todos</button>
        <button type="submit" name="acao" value="buscarNome">Consultar por nome</button>

        <button type="button" name="acao" value="selecionarAlterar">Alterar</button>
        <button type="button" name="acao" value="selecionarExcluir">Excluir</button>
        <!--Cria um campo para inserir o id (para alterar/excluir)-->
        <div id="campoDinamico"> </div>
    </form> <br>
</body>
</html>