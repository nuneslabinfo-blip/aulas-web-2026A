<?php
require_once __DIR__ . '/../dao/TarefaDao.php';

class TarefaController {
    public function salvar() {
        $t = new Tarefa(
            $_POST['titulo'], 
            $_POST['descricao'], 
            $_POST['data_prazo'], 
            $_POST['categoria_id'],
        );
        $dao = new TarefaDao();
        $dao->salvar($t);
        header("Location: listar_tarefas.php");
    }

    public function listar() {
        $dao = new TarefaDao();
        return $dao->listar();
    }

    public function excluir() {
        if (isset($_GET['id'])) {
            $dao = new TarefaDao();
            $dao->excluir($_GET['id']);
        }
    header("Location: listar_tarefas.php");
    exit;
    }

    public function buscarPorId($id) {
        $dao = new TarefaDao();
        return $dao->buscarPorId($id);
    }

    public function atualizar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dao = new TarefaDao();
            // O checkbox só envia dados se estiver marcado, por isso usamos o isset
            $status = isset($_POST['status']) ? true : false;
        
            $dao->atualizar(
                $_POST['id'],
                $_POST['titulo'],
                $_POST['descricao'],
                $_POST['data_prazo'],
                $_POST['categoria_id'],
                $status
            );
        header("Location: listar_tarefas.php");
        exit;
        }
    }
}