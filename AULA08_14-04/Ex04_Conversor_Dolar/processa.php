<?php
// Verifica se a requisição foi feita via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura o valor enviado pelo formulário 
    $valor_reais = $_POST['valor_real'];
    
    // Define o valor fixo do dólar conforme solicitado
    $cotacao_dolar = 4.98;
    
    // Realiza o cálculo da conversão
    $valor_dolares = $valor_reais / $cotacao_dolar;
    
    // Exibe o resultado formatado
    echo "<h3>Resultado da Conversão:</h3>";
    echo "Com R$ " . number_format($valor_reais, 2, ',', '.') . " você pode comprar ";
    echo "<strong>US$ " . number_format($valor_dolares, 2, '.', ',') . "</strong>";
}
?>