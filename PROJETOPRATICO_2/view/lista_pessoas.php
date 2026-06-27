<?php
require_once __DIR__ . '/../controller/PessoaController.php';
$controller = new PessoaController();

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    $controller->excluir();
}
$pessoas = $controller->listar();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pessoas</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<main>
    <h1>Pessoas Cadastradas</h1>
    
    <?php if (isset($_GET['erro']) && $_GET['erro'] == 'vinculo'): ?>
        <div style="background-color: #ffcccc; color: #cc0000; padding: 10px; margin-bottom: 15px; border-radius: 4px; font-weight: bold;">
            Não é possível excluir esta pessoa porque ela é responsável por alguma tarefa!
        </div>
    <?php endif; ?>

    <section class="acoes">
        <a href="cadastra_pessoa.php" class="btn">Nova Pessoa</a>
        <a href="listar_tarefas.php" class="btn">Voltar para Tarefas</a>
    </section>

    <table>
        <thead>
            <tr>
                <th>Nome / CPF</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($pessoas) > 0): ?>
                <?php foreach ($pessoas as $p): ?>
                <tr>
                    <td>
                        <strong><?= htmlspecialchars($p['nome']) ?></strong><br>
                        <small>CPF: <?= htmlspecialchars($p['cpf']) ?></small>
                    </td>
                    <td>
                        <?= htmlspecialchars($p['logradouro']) ?>, <?= htmlspecialchars($p['bairro']) ?><br>
                        <small><?= htmlspecialchars($p['cidade']) ?> - <?= htmlspecialchars($p['estado']) ?> (CEP: <?= htmlspecialchars($p['cep']) ?>)</small>
                    </td>
                    <td>
                        <a href="lista_pessoas.php?acao=excluir&id=<?= $p['id'] ?>" 
                           onclick=\"return confirm('Deseja realmente excluir esta pessoa?');\" style="color: red;">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3">Nenhuma pessoa cadastrada.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>
</body>
</html>