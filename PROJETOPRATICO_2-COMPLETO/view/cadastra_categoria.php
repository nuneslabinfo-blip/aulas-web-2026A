<?php
require_once __DIR__ . '/../controller/CategoriaController.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new CategoriaController();
    $controller->salvar();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova Categoria</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <main>
    <h1>Nova Categoria</h1>
    
    <form method="post" action="">
        <label>Nome da Categoria:</label>
        <input type="text" name="nome" required placeholder="Ex: Trabalho, Estudos, Pessoal...">
        
        <div class="botoes">
            <button type="submit">Salvar Categoria</button>
            <a href="lista_categorias.php">Cancelar</a>
        </div>
    </form>
</main>

</body>
</html>