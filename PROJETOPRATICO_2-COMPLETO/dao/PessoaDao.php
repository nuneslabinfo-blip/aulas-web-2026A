<?php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../model/Pessoa.php';

class PessoaDao {
    private $connection;

    public function __construct() {
        $db = new Database();
        $this->connection = $db->connection;
    }

    public function salvar(Pessoa $p) {
        $sql = "INSERT INTO pessoas (nome, cpf, cep, logradouro, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([
            $p->getNome(), $p->getCpf(), $p->getCep(), 
            $p->getLogradouro(), $p->getBairro(), $p->getCidade(), $p->getEstado()
        ]);
    }

    public function listar() {
        $sql = "SELECT * FROM pessoas ORDER BY nome";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluir($id) {
        $sql = "DELETE FROM pessoas WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
    }

    // Buscar uma pessoa específica pelo ID (usado na edição)
    public function buscarPorId($id) {
        $sql = "SELECT * FROM pessoas WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar os dados de uma pessoa
    public function atualizar($id, $nome, $cpf, $cep, $logradouro, $bairro, $cidade, $estado) {
        $sql = "UPDATE pessoas SET nome = ?, cpf = ?, cep = ?, logradouro = ?, bairro = ?, cidade = ?, estado = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$nome, $cpf, $cep, $logradouro, $bairro, $cidade, $estado, $id]);
    }
}