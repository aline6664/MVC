<?php

// A classe Cliente que vai acessar e buscar no banco de dados

class Cliente {
    // atributos
    private $conexao; // conexão com o banco de dados do tipo Database
    private $tableName = "clientes";
    
    public $id;
    public $nome;
    public $email;
    public $telefone;

    // métodos
    public function __construct($db) { // toda vez que cria um objeto Cliente precisa passar a database
        $this->conexao = $db;
    }

    // REGISTRAR CLIENTE
    public function criar() {
        // inserir usando parâmetros
        $comandoSQL = "INSERT INTO {$this->tableName} (nome, email, telefone) VALUES (:param1, :param2, :param3)";
        try {
            $acesso = $this->conexao->prepare($comandoSQL);
            $acesso->bindParam(':param1', $nome);
            $acesso->bindParam(':param2', $email);
            $acesso->bindParam(':param3', $telefone);
            $acesso->execute();
        }
        catch (PDOException $erro) {
            echo "Erro ao inserir na tabela 'clientes': " . $erro->getMessage();
        }
    }

    // LISTAR TODOS CLIENTES REGISTRADOS
    public function listar() {
        $comandoSQL = "SELECT * FROM . {$this->table_name} ORDER BY id DESC"; // ordenar por ID
        try {
            $acesso = $this->conexao->prepare($comandoSQL); // prepare() valida o comando SQL para o acesso
            $acesso->execute(); // executa o comando SQL
            return $acesso;
        }
        catch (PDOException $erro) {
            echo "Erro ao listar os clientes: " . $erro->getMessage();
        }
    }

    // BUSCAR CLIENTE PELO NOME
    public function buscarNome($nomeBusca) {
        // retornar linha(s) da tabela com o nome igual
        $comandoSQL = "SELECT * FROM {$this->tableName} WHERE nome = :nome";
        try {
            $acesso = $this->conexao->prepare($comandoSQL);
            $acesso->bindParam(':nome', $nomeBusca); // passando o parâmetro para o comando SQL
            $acesso->execute();
            return $acesso->fetchAll(PDO::FETCH_ASSOC); // retorna as linhas encontradas
        }
        catch (PDOException $erro) {
            echo "Erro ao recuperar cliente(s) por nome: " . $erro->getMessage();
        }
    }

    // ALTERAR DADOS DO CLIENTE
    public function alterar($id, $nome, $email, $telefone) {
        $comandoSQL = "UPDATE {$this->tableName} SET nome = :param1, email = :param2, telefone = :param3";
        try {
            $acesso = $this->conexao->prepare($comandoSQL);
            $acesso->bindParam(':param1', $nome);
            $acesso->bindParam(':param2', $email);
            $acesso->bindParam(':param3', $telefone);
            $acesso->execute();
            return $acesso->execute([$nome, $email, $telefone, $id]);    
        }
        catch (PDOException $erro) {
            echo "Erro ao alterar cliente: " . $erro->getMessage();
        }    
    }

    // APAGAR CLIENTE PELO ID
    public function excluir($id) {
        $comandoSQL = "DELETE FROM {$this->table_name} WHERE id = :id";
        try {
            $acesso = $this->conexao->prepare($comandoSQL);
            $acesso->bindParam(':id', $id);
            $acesso->execute();
        }
        catch (PDOException $erro) {
            echo "Erro ao excluir o cliente: " . $erro->getMessage();
        }
    }
}

?>