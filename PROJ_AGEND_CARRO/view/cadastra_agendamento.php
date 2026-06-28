<?php
require_once __DIR__ . '/../controller/AgendamentoController.php';
require_once __DIR__ . '/../controller/CarroController.php';

$carController = new CarroController();
$carros = $carController->listar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $agendamentoController = new AgendamentoController();
    $agendamentoController->salvar();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Agendamento</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <main>
        <h1>Novo Agendamento de Carro</h1>
        
        <form method="post" action="">
            <label>Motivo do Uso:</label>
            <input type="text" name="motivo" required placeholder="Ex: Viagem para filial">

            <label>Descrição:</label>
            <textarea name="descricao" placeholder="Detalhes ou observações..."></textarea>

            <label>Data de Uso:</label>
            <input type="date" name="data_uso" required>

            <label>Carro:</label>
            <select name="carro_id" required>
                <option value="">Selecione um carro...</option>
                <?php foreach ($carros as $car): ?>
                    <option value="<?= $car->getId() ?>"><?= $car->getModelo() ?> (<?= $car->getPlaca() ?>)</option>
                <?php endforeach; ?>
            </select>

            <div class="botoes">
                <button type="submit">Salvar Agendamento</button>
                <a href="listar_agendamentos.php">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>