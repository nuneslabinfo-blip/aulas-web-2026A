<?php
require_once __DIR__ . '/../controller/TarefaController.php';
require_once __DIR__ . '/../controller/CategoriaController.php';

// 1. Buscamos as categorias para preencher o <select> do formulário
$catController = new CategoriaController();
$categorias = $catController->listar();

// 2. Se o formulário for enviado, chamamos o salvar do controller de tarefas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tarefaController = new TarefaController();
    $tarefaController->salvar();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Tarefa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <main>
        <h1>Nova Tarefa</h1>
        
        <form method="post" action="">
            <label>Título da Tarefa:</label>
            <input type="text" name="titulo" required placeholder="Ex: Estudar PHP">

            <label>Descrição:</label>
            <textarea name="descricao" placeholder="Detalhes da tarefa..."></textarea>

            <label>Data de Prazo:</label>
            <input type="date" name="data_prazo" required>

            <label>Categoria:</label>
            <select name="categoria_id" required>
                <option value="">Selecione uma categoria...</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat->getId() ?>"><?= $cat->getNome() ?></option>
                <?php endforeach; ?>
            </select>

            <div class="botoes">
                <button type="submit">Salvar Tarefa</button>
                <a href="listar_tarefas.php">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>