<?php
require_once __DIR__ . '/../controller/AgendamentoController.php';
$controller = new AgendamentoController();

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    $controller->excluir();
}

$agendamentos = $controller->listar(); 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agenda de Carros</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<main>
    <h1>Controle de Agenda de Carros</h1>
    <section class="acoes">
        <a href="cadastra_agendamento.php" class="btn">Novo Agendamento</a>
        <a href="lista_carros.php" class="btn">Gerenciar Carros</a>
    </section>

    <table class="tabela-tarefas" border=\"1\" style=\"width:100%; border-collapse: collapse;\">
        <thead>
            <tr>
                <th>Motivo</th>
                <th>Data de Uso</th>
                <th>Carro</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($agendamentos) > 0): ?>
                <?php foreach ($agendamentos as $a): ?>
                <tr>
                    <td>
                        <strong><?= htmlspecialchars($a['motivo']) ?></strong><br>
                        <small><?= htmlspecialchars($a['descricao']) ?></small>
                    </td>
                    <td><?= date('d/m/Y', strtotime($a['data_uso'])) ?></td>
                    <td><?= htmlspecialchars($a['nome_carro']) ?> (<?= htmlspecialchars($a['placa_carro']) ?>)</td>
                    <td><?= $a['status'] ? 'Concluído' : 'Pendente' ?></td>
                    <td>
                        <a href="editar_agendamento.php?id=<?= $a['id'] ?>" style="text-decoration: none;">Editar</a> | 
                        <a href="listar_agendamentos.php?acao=excluir&id=<?= $a['id'] ?>" 
                           onclick=\"return confirm('Tem certeza que deseja apagar este agendamento?');\" 
                           style="color: red; text-decoration: none;">
                           Excluir
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">Nenhum agendamento encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>
</body>
</html>