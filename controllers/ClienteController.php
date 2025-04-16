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

    public function listarTodos() {
        // o controlador pede para a classe Cliente (clienteModel) acessar o db
        $clientes = $this->clienteModel->buscarTodos();
        require_once "../views/ClienteListarTodos.php"; // chama a view (tela) para exibir
    }
}

?>