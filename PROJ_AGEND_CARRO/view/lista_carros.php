<?php
require_once __DIR__ . '/../controller/CarroController.php';
$controller = new CarroController();

if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    $controller->excluir();
}

$carros = $controller->listar();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Carros</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<main>
    <h1>Carros Cadastrados</h1>
    
    <?php if (isset($_GET['erro']) && $_GET['erro'] == 'vinculo'): ?>
        <div style="background-color: #ffcccc; color: #cc0000; padding: 10px; border: 1px solid #cc0000; margin-bottom: 15px; border-radius: 4px; font-weight: bold;">
            Não é possível excluir este carro porque ele possui agendamentos vinculados!
        </div>
    <?php endif; ?>

    <div class="acoes">
        <a href="cadastra_carro.php">Novo Carro</a> | 
        <a href="listar_agendamentos.php">Voltar para Agenda</a>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 15%;">ID</th>
                <th>Modelo do Carro</th>
                <th>Placa</th>
                <th style="width: 20%;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($carros) > 0): ?>
                <?php foreach ($carros as $car): ?>
                <tr>
                    <td><?= $car->getId() ?></td>
                    <td><?= htmlspecialchars($car->getModelo()) ?></td>
                    <td><?= htmlspecialchars($car->getPlaca()) ?></td>
                    <td>
                        <a href="lista_carros.php?acao=excluir&id=<?= $car->getId() ?>" 
                           onclick="return confirm('Tem certeza que deseja excluir este carro?');" 
                           style="color: #e74c3c; font-weight: bold;">
                            Excluir
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Nenhum carro encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>
</body>
</html>