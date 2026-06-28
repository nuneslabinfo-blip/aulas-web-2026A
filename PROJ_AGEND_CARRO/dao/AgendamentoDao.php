<?php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../model/Agendamento.php';

class AgendamentoDao {
    private $connection;

    public function __construct() {
        $db = new Database();
        $this->connection = $db->connection;
    }

    public function salvar(Agendamento $a) {
        $sql = "INSERT INTO agendamentos (motivo, descricao, data_uso, carro_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$a->getMotivo(), $a->getDescricao(), $a->getDataUso(), $a->getCarroId()]);
    }

    public function listar() {
        $sql = "SELECT a.*, c.modelo as nome_carro, c.placa as placa_carro 
                FROM agendamentos a 
                JOIN carros c ON a.carro_id = c.id 
                ORDER BY a.data_uso ASC";
        $stmt = $this->connection->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function excluir($id) {
        $sql = "DELETE FROM agendamentos WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
    }

    public function buscarPorId($id) {
        $sql = "SELECT * FROM agendamentos WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $motivo, $descricao, $data_uso, $carro_id, $status) {
        $sql = "UPDATE agendamentos SET motivo = ?, descricao = ?, data_uso = ?, carro_id = ?, status = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$motivo, $descricao, $data_uso, $carro_id, $status, $id]);
    }
}