<?php
require_once __DIR__ . '/../controller/PessoaController.php';

$pessoaController = new PessoaController();

// 1. Se o formulário foi submetido, processa a atualização
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pessoaController->atualizar();
}

// 2. Carrega os dados atuais da pessoa para preencher o formulário
if (isset($_GET['id'])) {
    $pessoa = $pessoaController->buscarPorId($_GET['id']);
    if (!$pessoa) {
        header("Location: lista_pessoas.php");
        exit;
    }
} else {
    header("Location: lista_pessoas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pessoa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<main>
    <h1>Editar Pessoa</h1>
    
    <form method="post" action="">
        <input type="hidden" name="id" value="<?= $pessoa['id'] ?>">

        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($pessoa['nome']) ?>" required placeholder="Nome completo">

        <label>CPF:</label>
        <input type="text" name="cpf" value="<?= htmlspecialchars($pessoa['cpf']) ?>" required placeholder="000.000.000-00">

        <label>CEP (Digite para buscar o endereço automaticamente):</label>
        <input type="text" id="cep" name="cep" value="<?= htmlspecialchars($pessoa['cep']) ?>" required placeholder="Ex: 95900000" onblur="buscarCep()">

        <label>Rua/Logradouro:</label>
        <input type="text" id="logradouro" name="logradouro" value="<?= htmlspecialchars($pessoa['logradouro']) ?>" required placeholder="Rua, Av...">

        <label>Bairro:</label>
        <input type="text" id="bairro" name="bairro" value="<?= htmlspecialchars($pessoa['bairro']) ?>" required placeholder="Bairro">

        <label>Cidade:</label>
        <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($pessoa['cidade']) ?>" required placeholder="Cidade">

        <label>Estado:</label>
        <input type="text" id="estado" name="estado" value="<?= htmlspecialchars($pessoa['estado']) ?>" required placeholder="UF">

        <div class="botoes" style="display: flex; gap: 10px; margin-top: 10px;">
            <button type="submit">Salvar Alterações</button>
            <a href="lista_pessoas.php" class="btn" style="background-color: #bdc3c7; color: #333; text-align: center; line-height: 20px;">Cancelar</a>
        </div>
    </form>
</main>

<script>
function buscarCep() {
    const cep = document.getElementById('cep').value.replace(/\D/g, '');
    if (cep.length !== 8) return;

    document.getElementById('logradouro').value = "Buscando...";
    document.getElementById('bairro').value = "Buscando...";
    document.getElementById('cidade').value = "Buscando...";
    document.getElementById('estado').value = "Buscando...";

    const url = `https://brasilapi.com.br/api/cep/v1/${cep}`;

    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error('CEP não encontrado');
            return response.json();
        })
        .then(dados => {
            document.getElementById('logradouro').value = dados.street || '';
            document.getElementById('bairro').value = dados.neighborhood || '';
            document.getElementById('cidade').value = dados.city || '';
            document.getElementById('estado').value = dados.state || '';
        })
        .catch(error => {
            alert('Erro ao buscar o CEP ou CEP inexistente.');
            document.getElementById('logradouro').value = "";
            document.getElementById('bairro').value = "";
            document.getElementById('cidade').value = "";
            document.getElementById('estado').value = "";
        });
}
</script>
</body>
</html>