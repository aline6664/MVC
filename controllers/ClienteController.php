<?php

require_once "../models/Cliente.php";
require_once "../models/Database.php";

// O controlador vai gerenciar as telas e os objetos da classe Cliente

class ClienteController {
    // atributos
    private $clienteModel; // objeto da classe Cliente
    private $db; // opcional

    // métodos
    public function __construct() {
        // Toda vez que inicializa o controlador, inicializa um objeto Cliente
        $this->db = new Database('localhost','bancoWeb','root','');
        $this->clienteModel = new Cliente($this->db->getConnection());
    }
    public function apresentarForm() {
        require_once "../views/form.php";
    }

    // Funções que são chamadas quando o usuário CLICA nos botões correspondentes na tela (view)
    // papel deles é chamar as funções do Cliente model

    public function clienteCriar() {
        $dados = $this->cliente->criar($_POST['nome'], $_POST['email'], $_POST['telefone']);
        header("Location: views/cliente_index.php");
        exit;
    }

    public function clienteListar() {
        $dados = $this->cliente->listar();
        // require "views/cliente_list.php"; // chama a tela que lista os clientes
    }

    public function clienteAlterar() {
        if ($_POST) { // verifica se o formulário foi submetido (via POST)
            $this->cliente->alterar($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
            header("Location: views/cliente_index.php");
            exit;
        }
    }

    public function clienteExcluir() {
        if (isset($_GET['id'])) { // verifica se cliente com este id existe (via GET)
            $this->cliente->excluir($_GET['id']);
            header("Location: views/cliente_index.php");
            exit;
        }
    }

    // Função extra que é chamada quando for alterar
    // ela mostra um form para editar diretamente por ele
    public function editarForm() {
        if (!isset($_GET['id'])) {  // se o campo não for preenchido ...
            die("ID não informado.");
        }

        $cliente = $this->cliente->buscarPorId($_GET['id']); // se o ID não existir ...
        if (!$cliente) {
            die("Cliente não encontrado.");
        }

        require "views/cliente_alterar.php";
    }

    public function clienteListarTodos() {
        // o controlador pede para a classe Cliente (clienteModel) acessar o db
        $clientes = $this->clienteModel->buscarTodos();
        require_once "../views/ClienteListarTodos.php"; // chama a view (tela) para exibir
    }
}

?>