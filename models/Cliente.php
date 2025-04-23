<?php

// a classe Cliente que vai acessar e buscar no banco de dados

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

    public function criar() {
        // inserir usando parâmetros
        $comandoSQL = 'INSERT INTO ' . $this->tableName . ' (nome, email, telefone) VALUES (:param1, :param2, :param3)';
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

    public function buscarTodos() {
        $comandoSQL = "SELECT * FROM " . $this->tableName;
        try {
            $acesso = $this->conexao->prepare($comandoSQL); // prepare() valida o comando SQL para o acesso
            $acesso->execute(); // executa o comando SQL
            return $acesso;
        }
        catch (PDOException $erro) {
            echo "Erro ao buscar os clientes: " . $erro->getMessage();
        }
    }

    public function buscar($nomeBusca) {
        // retornar a linha da tabela com o nome igual
        $comandoSQL = 'SELECT * FROM ' . $this->tableName . ' WHERE nome = :nome';
        try {
            $acesso = $this->conexao->prepare($comandoSQL);
            $acesso->bindParam(':nome', $nomeBusca); // passando o parâmetro para o comando SQL
            $acesso->execute();
            return $acesso->fetchAll(PDO::FETCH_ASSOC); // retorna as linhas encontradas
        }
        catch (PDOException $erro) {
            echo "Erro ao recuperar o cliente por nome: " . $erro->getMessage();
        }
    }

    public function apagar($id) {
        $comandoSQL = 'DELETE FROM ' . $this->tableName . ' WHERE id = :id';
        try {
            $acesso = $this->conexao->prepare($comandoSQL);
            $acesso->bindParam(':id', $id);
            $acesso->execute();
        }
        catch (PDOException $erro) {
            echo "Erro ao excluir o cliente: " . $erro->getMessage();
        }
    }

    public function alterar($nome = null, $email = null, $telefone = null) {
        $campos = []; // array de campos que foram alterados
        $parametros = []; // array de valores recebidos
        if ($nome) {
            $campos[] = "nome = ?"; // ? -> valor placeholder do parametro query
            $parametros[] = $nome;
        }
        if ($email) {
            $campos[] = "email = ?";
            $parametros[] = $email;
        }
        if ($telefone) {
            $campos[] = "telefone = ?";
            $parametros[] = $telefone;
        }
        // se nenhum campo for passado (array de campos está vazio)
        if (count($campos) === 0) {
            return false;
        }
        // query SQL criado dinamicamente
        // implode() junto os valores da array $campos separados por vírgula
        $comandoSQL = 'UPDATE ' . $this->tableName . ' SET ' . implode(", ", $campos) . ' WHERE id = ?';
        $parametros[] = $id;
    
    }
}

?>