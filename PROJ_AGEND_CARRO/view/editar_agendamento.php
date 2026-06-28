<?php
require_once __DIR__ . '/../controller/AgendamentoController.php';
require_once __DIR__ . '/../controller/CarroController.php';

$agendamentoController = new AgendamentoController();
$carController = new CarroController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $agendamentoController->atualizar();
}

if (isset($_GET['id'])) {
    $agendamento = $agendamentoController->buscarPorId($_GET['id']);
    $carros = $carController->listar();
} else {
    header("Location: listar_agendamentos.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Agendamento</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <main>
        <h1>Editar Agendamento</h1>
        
        <form method="post" action="">
            <input type="hidden" name="id" value="<?= $agendamento['id'] ?>">

            <label>Motivo:</label>
            <input type="text" name="motivo" value="<?= htmlspecialchars($agendamento['motivo']) ?>" required>

            <label>Descrição:</label>
            <textarea name="descricao"><?= htmlspecialchars($agendamento['descricao']) ?></textarea>

            <label>Data de Uso:</label>
            <input type="date" name="data_uso" value="<?= $agendamento['data_uso'] ?>" required>

            <label>Carro:</label>
            <select name="carro_id" required>
                <?php foreach ($carros as $car): ?>
                    <option value="<?= $car->getId() ?>" <?= $car->getId() == $agendamento['carro_id'] ? 'selected' : '' ?>>
                        <?= $car->getModelo() ?> (<?= $car->getPlaca() ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <br><br>
            <label>
                <input type="checkbox" name="status" value="1" <?= $agendamento['status'] ? 'checked' : '' ?>>
                <strong>Uso Concluído / Devolvido</strong>
            </label>
            <br><br>

            <div class="botoes">
                <button type="submit">Salvar Alterações</button>
                <a href="listar_agendamentos.php">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>