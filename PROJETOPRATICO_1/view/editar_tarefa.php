<?php
require_once __DIR__ . '/../controller/TarefaController.php';
require_once __DIR__ . '/../controller/CategoriaController.php';

$tarefaController = new TarefaController();
$catController = new CategoriaController();

// 1. Se o formulário foi enviado, processa a atualização
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tarefaController->atualizar();
}

// 2. Carrega os dados atuais da tarefa para exibir no formulário
if (isset($_GET['id'])) {
    $tarefa = $tarefaController->buscarPorId($_GET['id']);
    $categorias = $catController->listar();
} else {
    header("Location: listar_tarefas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <main>
        <h1>Editar Tarefa</h1>
        
        <form method="post" action="">
            <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">

            <label>Título:</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($tarefa['titulo']) ?>" required>

            <label>Descrição:</label>
            <textarea name="descricao"><?= htmlspecialchars($tarefa['descricao']) ?></textarea>

            <label>Data de Prazo:</label>
            <input type="date" name="data_prazo" value="<?= $tarefa['data_prazo'] ?>" required>

            <label>Categoria:</label>
            <select name="categoria_id" required>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat->getId() ?>" <?= $cat->getId() == $tarefa['categoria_id'] ? 'selected' : '' ?>>
                        <?= $cat->getNome() ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <br><br>
            <label>
                <input type="checkbox" name="status" value="1" <?= $tarefa['status'] ? 'checked' : '' ?>>
                <strong>Tarefa Concluída</strong>
            </label>
            <br><br>

            <div class="botoes">
                <button type="submit">Salvar Alterações</button>
                <a href="listar_tarefas.php">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>