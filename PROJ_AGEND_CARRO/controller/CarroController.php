<?php
require_once __DIR__ . '/../dao/CarroDao.php';

class CarroController {
    public function listar() {
        $dao = new CarroDao();
        return $dao->listar();
    }

    public function salvar() {
        $c = new Carro($_POST['modelo'], $_POST['placa']);
        $dao = new CarroDao();
        $dao->salvar($c);
        header("Location: lista_carros.php");
    }

    public function excluir() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $dao = new CarroDao();
            try {
                $dao->excluir($id);
                header("Location: lista_carros.php");
                exit;
            } catch (PDOException $e) {
                if ($e->getCode() == '23503') {
                    header("Location: lista_carros.php?erro=vinculo");
                    exit;
                } else {
                    die("Erro ao excluir: " . $e->getMessage());
                }
            }
        }
    }
}