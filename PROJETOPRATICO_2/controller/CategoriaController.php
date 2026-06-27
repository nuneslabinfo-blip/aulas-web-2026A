<?php
// ==========================================================================================
// IMPORTAÇÃO DE DEPENDÊNCIAS
// ==========================================================================================
// Carrega a classe CategoriaDao para permitir a comunicação com o banco de dados.
require_once __DIR__ . '/../dao/CategoriaDao.php';


// CLASSE: CategoriaController
// OBJETIVO: Atuar como intermediária (Controladora) entre as páginas web (Views) e o banco (DAO).
class CategoriaController {

    // MÉTODO: listar
    // OBJETIVO: Buscar e retornar todas as categorias gravadas no banco de dados.
    // ONDE É USADO: Na página "lista_categorias.php" (para montar a tabela) e na página
    public function listar() {
        $dao = new CategoriaDao();
        return $dao->listar();
    }

    public function salvar() {
        $c = new Categoria($_POST['nome']);
        $dao = new CategoriaDao();
        $dao->salvar($c);
        header("Location: lista_categorias.php");
    }

    public function excluir() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $dao = new CategoriaDao();
        
        //Verificação de erro por estar vinculado alguma tarefa
        try {
            $dao->excluir($id);
            // Se der certo, redireciona normalmente
            header("Location: lista_categorias.php");
            exit;
        } catch (PDOException $e) {
            // O código 23503 é o padrão do PostgreSQL para violação de chave estrangeira
            if ($e->getCode() == '23503') {
                header("Location: lista_categorias.php?erro=vinculo");
                exit;
            } else {
                // Caso seja outro erro qualquer do banco, mostra a mensagem real
                die("Erro ao excluir: " . $e->getMessage());
                }
            }
        }
    }
}