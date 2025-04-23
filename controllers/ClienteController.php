<?php

require_once "../models/Cliente.php";
require_once "../models/Database.php";

// o controlador vai gerenciar as telas e os objetos da classe Cliente

class ClienteController {
    // atributos
    private $clienteModel; // objeto da classe Cliente
    private $db; // opcional

    // métodos
    public function __construct() {
        // toda vez que inicializa o controlador, inicializa um objeto Cliente
        $this->db = new Database('localhost','bancoWeb','root','');
        $this->clienteModel = new Cliente($this->db->getConnection());
    }
    public function apresentarForm() {
        require_once "../views/form.php";
    }

    public function enviarForm() {
            // Verifica se o formulário foi submetido
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($nome) && !empty($email) && !empty($telefone)) {
            // Captura os dados do formulário
            $acao = $_POST['acao'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            if (isset($_POST['id'])) { // se o id for passado pelo usuario no alterar/excluir
                $idBusca = $_POST['id'];
            }

            // Registrar novo cliente
            $cliente = new Cliente();
            if ($acao == "incluir") {
                $id = $cliente->create($nome, $email, $telefone); // recebendo o ID auto incrementado
                if ($id !== false) {
                    echo "<p>Cadastro inserido com sucesso.</p>";
                }
                else {
                    echo "<p>Erro ao incluir cadastro.</p>";
                }
            }
            // Listar todos os clientes registrados
            else if ($acao == "listar") {
                $listaGatos = $bdGatos->recovery();
                if ($listaGatos) {
                    foreach ($listaGatos as $gato) {
                        echo "Código: " . $gato['gat_cod'] . "<br>";
                        echo "Nome: " . $gato['gat_nome'] . "<br>";
                        echo "Raça: " . $gato['gat_raca'] . "<br>";
                        echo "Cor: " . $gato['gat_cor'] . "<br>";
                        echo "Sexo: " . $gato['gat_sexo'] . "<br><br>";
                    }
                }
                else {
                    echo "<p>Erro ao consultar registros.</p>";
                }
            }
            // Buscar o gato registrado por nome
            else if ($acao == "buscarNome") {
                $listaGatos = $bdGatos->recoveryByName($nome);
                // var_dump($listaGatos); // teste para checar array de dados
                if ($listaGatos && is_array($listaGatos)) { // array pois varios gatos podem ter mesmo nome
                    foreach ($listaGatos as $gato) {
                        echo "Código: " . $gato['gat_cod'] . "<br>";
                        echo "Nome: " . $gato['gat_nome'] . "<br>";
                        echo "Raça: " . $gato['gat_raca'] . "<br>";
                        echo "Cor: " . $gato['gat_cor'] . "<br>";
                        echo "Sexo: " . $gato['gat_sexo'] . "<br><br>";
                    }
                }
                else {
                    echo "<p>Erro ao consultar registro(s) por nome.</p>";
                }
            }
            // Alterar dados do cliente
            else if ($acao == "alterar") {
                $gato = $bdGatos->update($codigoBusca, $nome, $raca, $cor, $sexo);
                if ($gato) {
                    echo "<p>Dados alterados com sucesso.</p>";
                }
                else {
                    echo "<p>Erro ao alterar os dados.</p>";
                }
            }
            // Apagar registro do cliente
            else if ($acao == "excluir") {
                if ($bdGatos->delete($codigoBusca)) {
                    echo "<p>Registro apagado com sucesso.</p>";
                }
                else {
                    echo "<p>Erro ao apagar registro. Código inexistente.</p>";
                }
            }
            else {
                echo "<p>Ação inválida. Por favor, tente novamente.</p>";
            }

            // Exibe os dados - teste para verificar se os dados foram recebidos
            echo "<h2>Dados Recebidos:</h2>";
            if (isset($_POST['id'])) {
                echo "ID: . $idBusca . <br>";
            }
            echo "Nome: " . $nome . "<br>";
            echo "E-mail: " . $email . "<br>";
            echo "Telefone: " . $telefone . "<br>";
        }
    }

    public function listarTodos() {
        // o controlador pede para a classe Cliente (clienteModel) acessar o db
        $clientes = $this->clienteModel->buscarTodos();
        require_once "../views/ClienteListarTodos.php"; // chama a view (tela) para exibir
    }
}

?>