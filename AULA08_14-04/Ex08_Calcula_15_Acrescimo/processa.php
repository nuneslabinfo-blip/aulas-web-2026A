<?php
// Verifica se a requisição foi feita via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura o valor enviado pelo formulário
    $preco = $_POST['preco_original'];
    //==============================================================
    
    // Calcula o valor com acréscimo de 15% (multiplicando por 1.15)
    $novo_preco = $preco * 1.15;
    //==============================================================
    
    // Exibe o resultado na tela
    echo "<h3>Resultado do Reajuste:</h3>";
    echo "O preço original era: R$ " . number_format($preco, 2, ',', '.') . "<br>";
    echo "<strong>O preço com 15% de acréscimo é: R$ " . number_format($novo_preco, 2, ',', '.') . "</strong>";
}
?>