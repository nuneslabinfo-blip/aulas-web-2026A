<?php
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/../model/Tarefa.php';

class TarefaDao {
    private $connection;

    public function __construct() {
        $db = new Database();
        $this->connection = $db->connection;
    }

    public function salvar(Tarefa $t) {
    $sql = "INSERT INTO tarefas (titulo, descricao, data_prazo, categoria_id, pessoa_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $this->connection->prepare($sql);
    $stmt->execute([$t->getTitulo(), $t->getDescricao(), $t->getDataPrazo(), $t->getCategoriaId(), $_POST['pessoa_id']]);
}

    public function listar() {
    $sql = "SELECT t.*, c.nome as nome_categoria, p.nome as nome_responsavel 
            FROM tarefas t 
            JOIN categorias c ON t.categoria_id = c.id 
            LEFT JOIN pessoas p ON t.pessoa_id = p.id
            ORDER BY t.data_prazo ASC";
    $stmt = $this->connection->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // Deletar tarefa
    public function excluir($id) {
        $sql = "DELETE FROM tarefas WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
    }

    // Buscar uma tarefa específica pelo ID (usado na edição)
    public function buscarPorId($id) {
        $sql = "SELECT * FROM tarefas WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar os dados da tarefa
    public function atualizar($id, $titulo, $descricao, $data_prazo, $categoria_id, $status) {
        $sql = "UPDATE tarefas SET titulo = ?, descricao = ?, data_prazo = ?, categoria_id = ?, status = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        // Convertendo o status vindo do checkbox para booleano (true/false)
        $stmt->execute([$titulo, $descricao, $data_prazo, $categoria_id, $status ? 1 : 0, $id]);
    }
}