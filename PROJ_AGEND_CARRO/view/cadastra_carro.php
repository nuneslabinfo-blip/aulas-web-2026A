<?php
require_once __DIR__ . '/../controller/CarroController.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new CarroController();
    $controller->salvar();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Novo Carro</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <main>
    <h1>Novo Carro</h1>
    
    <form method="post" action="">
        <label>Modelo do Carro:</label>
        <input type="text" name="modelo" required placeholder="Ex: Honda HR-V, Toyota Corolla...">
        
        <label>Placa:</label>
        <input type="text" name="placa" required placeholder="Ex: ABC-1234">
        
        <div class="botoes">
            <button type="submit">Salvar Carro</button>
            <a href="lista_carros.php">Cancelar</a>
        </div>
    </form>
</main>
</body>
</html>