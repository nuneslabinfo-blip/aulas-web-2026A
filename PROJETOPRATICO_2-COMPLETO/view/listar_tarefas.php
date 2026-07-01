<?php
// 1. Importa o Controller necessário
require_once __DIR__ . '/../controller/TarefaController.php';

// 2. Instancia o Controller para ter acesso aos métodos
$controller = new TarefaController();

// 3. Intercepta a ação de exclusão se ela for chamada
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    $controller->excluir();
}

// 4. Busca a lista de tarefas (isso cria a variável $tarefas que o foreach usa)
$tarefas = $controller->listar(); 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<main>
    <h1>Minhas Tarefas</h1>
    <section class="acoes">
    <a href="lista_pessoas.php" class="btn">Gerenciar Pessoas</a>
    <a href="cadastra_tarefa.php" class="btn">Nova Tarefa</a>
    <a href="lista_categorias.php" class="btn">Gerenciar Categorias</a>
    <a href="mural_declaracoes.php" class="btn">Gerenciar Mural</a>
</section>

    <table class="tabela-tarefas" border="1" style="width:100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>Título</th>
            <th>Prazo</th>
            <th>Categoria</th>
            <th>Status</th>
            <th>Ações</th> </tr>
    </thead>
    <tbody>
        <?php if (count($tarefas) > 0): ?>
            <?php foreach ($tarefas as $t): ?>
            <tr>
                <td>
                    <strong><?= htmlspecialchars($t['titulo']) ?></strong><br>
                    <small style="color: #16a085;">Responsável: <?= htmlspecialchars($t['nome_responsavel'] ?? 'Ninguém atribuído') ?></small><br>
                    <small><?= htmlspecialchars($t['descricao']) ?></small>
                </td>
                <td><?= date('d/m/Y', strtotime($t['data_prazo'])) ?></td>
                <td><?= htmlspecialchars($t['nome_categoria']) ?></td>
                <td><?= $t['status'] ? 'Concluída' : 'Pendente' ?></td>
                <td>
                    <a href="editar_tarefa.php?id=<?= $t['id'] ?>" style="text-decoration: none;">Editar</a> | 
                    <a href="listar_tarefas.php?acao=excluir&id=<?= $t['id'] ?>" 
                       onclick="return confirm('Tem certeza que deseja apagar esta tarefa?');" 
                       style="color: red; text-decoration: none;">
                       Excluir
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">Nenhuma tarefa encontrada.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</main>

</body>
</html>