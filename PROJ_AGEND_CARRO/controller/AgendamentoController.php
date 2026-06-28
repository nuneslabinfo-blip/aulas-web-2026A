<?php
require_once __DIR__ . '/../dao/AgendamentoDao.php';

class AgendamentoController {
    public function salvar() {
        $a = new Agendamento($_POST['motivo'], $_POST['descricao'], $_POST['data_uso'], $_POST['carro_id']);
        $dao = new AgendamentoDao();
        $dao->salvar($a);
        header("Location: listar_agendamentos.php");
    }

    public function listar() {
        $dao = new AgendamentoDao();
        return $dao->listar();
    }

    public function excluir() {
        if (isset($_GET['id'])) {
            $dao = new AgendamentoDao();
            $dao->excluir($_GET['id']);
        }
        header("Location: listar_agendamentos.php");
        exit;
    }

    public function buscarPorId($id) {
        $dao = new AgendamentoDao();
        return $dao->buscarPorId($id);
    }

    public function atualizar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dao = new AgendamentoDao();
            $status = isset($_POST['status']) ? true : false;
        
            $dao->atualizar(
                $_POST['id'],
                $_POST['motivo'],
                $_POST['descricao'],
                $_POST['data_uso'],
                $_POST['carro_id'],
                $status
            );
            header("Location: listar_agendamentos.php");
            exit;
        }
    }
}