<?php
// Verifica se a requisição foi feita via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura os dados enviados pelos inputs do formulário
    $nome = $_POST['nome_prod'];
    $preco = $_POST['preco_prod'];
    //=====================================================
    
    // Converte o nome do produto para letras maiúsculas
    $nome_maiusculo = strtoupper($nome);
    //=====================================================

    // Exibe as informações recebidas
    echo "<h3>Dados do Produto Recebidos:</h3>";
    echo "Produto: " . $nome_maiusculo . "<br>";
    echo "Preço Informado: R$ " . number_format($preco, 2, ',', '.');
}
?>