<?php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../model/Categoria.php';

class CategoriaDao {
    private $tabela = 'categorias';
    private $connection;

    public function __construct() {
        $db = new Database();
        $this->connection = $db->connection;
    }

    public function salvar(Categoria $c) {
        $sql = "INSERT INTO $this->tabela (nome) VALUES (?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$c->getNome()]);
    }

    public function excluir($id) {
    $sql = "DELETE FROM $this->tabela WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([$id]);
    }

    public function listar() {
        $sql = "SELECT * FROM $this->tabela ORDER BY nome";
        $stmt = $this->connection->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lista = [];
        foreach ($rows as $row) {
            $lista[] = new Categoria($row['nome'], $row['id']);
        }
        return $lista;
    }
}