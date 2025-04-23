<?php
    require_once "../controllers/ClienteController.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testando Projeto MVC</title>
</head>
<body>
    <?php
        $cliController = new ClienteController();
        // form
        $cliController->apresentarForm();

        // ações
        $cliController->listarTodos();
        // chamando o ClienteController para listar todos clientes
        // ele irá chamar ambos o ClienteListarTodos e a classe Cliente
    ?>
</body>
</html>