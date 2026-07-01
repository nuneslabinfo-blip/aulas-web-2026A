<?php
require_once __DIR__ . '/../controller/CategoriaController.php';

$controller = new CategoriaController();

// Verifica se a ação de excluir foi acionada via URL
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    $controller->excluir();
}

$categorias = $controller->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Categorias</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main>
    <h1>Categorias Cadastradas</h1>
    
    <?php if (isset($_GET['erro']) && $_GET['erro'] == 'vinculo'): ?>
        <div style="background-color: #ffcccc; color: #cc0000; padding: 10px; border: 1px solid #cc0000; margin-bottom: 15px; border-radius: 4px; font-weight: bold;">
            Não é possível excluir esta categoria porque ela possui tarefas vinculadas!
        </div>
    <?php endif; ?>

    <div class="acoes">
        <a href="cadastra_categoria.php">Nova Categoria</a> | 
        <a href="listar_tarefas.php">Voltar para Tarefas</a>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 15%;">ID</th>
                <th>Nome da Categoria</th>
                <th style="width: 20%;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($categorias) > 0): ?>
                <?php foreach ($categorias as $cat): ?>
                <tr>
                    <td><?= $cat->getId() ?></td>
                    <td><?= htmlspecialchars($cat->getNome()) ?></td>
                    <td>
                        <a href="lista_categorias.php?acao=excluir&id=<?= $cat->getId() ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir esta categoria?');" 
                           style="color: #e74c3c; font-weight: bold;">
                            Excluir
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Nenhuma categoria encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

</body>
</html>