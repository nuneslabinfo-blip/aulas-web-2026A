<?php
require_once __DIR__ . '/../controller/PessoaController.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller = new PessoaController();
    $controller->salvar();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova Pessoa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<main>
    <h1>Nova Pessoa</h1>
    <form method="post" action="">
        <label>Nome:</label>
        <input type="text" name="nome" required placeholder="Nome completo">

        <label>CPF:</label>
        <input type="text" name="cpf" required placeholder="000.000.000-00">

        <label>CEP (Digite para buscar o endereço automaticamente):</label>
        <input type="text" id="cep" name="cep" required placeholder="Ex: 95900000" onblur="buscarCep()">

        <label>Rua/Logradouro:</label>
        <input type="text" id="logradouro" name="logradouro" required placeholder="Rua, Av...">

        <label>Bairro:</label>
        <input type="text" id="bairro" name="bairro" required placeholder="Bairro">

        <label>Cidade:</label>
        <input type="text" id="cidade" name="cidade" required placeholder="Cidade">

        <label>Estado (UF):</label>
        <input type="text" id="estado" name="estado" required placeholder="Ex: RS" maxlength="2">

        <div class="botoes">
            <button type="submit">Salvar Pessoa</button>
            <a href="lista_pessoas.php">Cancelar</a>
        </div>
    </form>
</main>

<script>
function buscarCep() {
    // Remove qualquer caractere que não seja número
    const cep = document.getElementById('cep').value.replace(/\D/g, '');
    
    if (cep.length !== 8) return;

    document.getElementById('logradouro').value = "Buscando...";
    document.getElementById('bairro').value = "Buscando...";
    document.getElementById('cidade').value = "Buscando...";
    document.getElementById('estado').value = "Buscando...";

    // URL oficial da BrasilAPI para consulta de CEP
    const url = `https://brasilapi.com.br/api/cep/v1/${cep}`;

    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error('CEP não encontrado');
            return response.json();
        })
        .then(dados => {
            // Preenche os campos do formulário automaticamente de acordo com o retorno da API
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