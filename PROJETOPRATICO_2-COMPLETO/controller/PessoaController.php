<?php
require_once __DIR__ . '/../dao/PessoaDao.php';
require_once __DIR__ . '/../model/Pessoa.php';

class PessoaController {
    public function listar() {
        $dao = new PessoaDao();
        return $dao->listar();
    }

    public function salvar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $p = new Pessoa(
                $_POST['nome'], $_POST['cpf'], $_POST['cep'],
                $_POST['logradouro'], $_POST['bairro'], $_POST['cidade'], $_POST['estado']
            );
            $dao = new PessoaDao();
            $dao->salvar($p);
            header("Location: lista_pessoas.php");
            exit;
        }
    }

    public function excluir() {
        if (isset($_GET['id'])) {
            $dao = new PessoaDao();
            try {
                $dao->excluir($_GET['id']);
                header("Location: lista_pessoas.php");
                exit;
            } catch (PDOException $e) {
                if ($e->getCode() == '23503') {
                    header("Location: lista_pessoas.php?erro=vinculo");
                    exit;
                } else {
                    die("Erro ao excluir pessoa: " . $e->getMessage());
                }
            }
        }
    }

    // Buscar pessoa por ID para a edição
    public function buscarPorId($id) {
        $dao = new PessoaDao();
        return $dao->buscarPorId($id);
    }

    // Processar a atualização
    public function atualizar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dao = new PessoaDao();
            $dao->atualizar(
                $_POST['id'],
                $_POST['nome'],
                $_POST['cpf'],
                $_POST['cep'],
                $_POST['logradouro'],
                $_POST['bairro'],
                $_POST['cidade'],
                $_POST['estado']
            );
            header("Location: lista_pessoas.php");
            exit;
        }
    }
}