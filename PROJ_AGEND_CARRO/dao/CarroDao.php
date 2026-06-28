<?php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../model/Carro.php';

class CarroDao {
    private $tabela = 'carros';
    private $connection;

    public function __construct() {
        $db = new Database();
        $this->connection = $db->connection;
    }

    public function salvar(Carro $c) {
        $sql = "INSERT INTO $this->tabela (modelo, placa) VALUES (?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$c->getModelo(), $c->getPlaca()]);
    }

    public function excluir($id) {
        $sql = "DELETE FROM $this->tabela WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
    }

    public function listar() {
        $sql = "SELECT * FROM $this->tabela ORDER BY modelo";
        $stmt = $this->connection->query($sql);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lista = [];
        foreach ($rows as $row) {
            $lista[] = new Carro($row['modelo'], $row['placa'], $row['id']);
        }
        return $lista;
    }
}