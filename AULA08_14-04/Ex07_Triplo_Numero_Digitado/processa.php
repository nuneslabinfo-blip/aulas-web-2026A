<?php
// Verifica se a requisição foi feita via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura o número enviado pelo formulário
    $numero = $_POST['numero_valor'];
    //==========================================

    // Calcula o triplo do número informado
    $resultado = $numero * 3;
    //==========================================
    
    // Exibe o resultado na tela
    echo "<h3>Resultado do Cálculo:</h3>";
    echo "O triplo do número " . $numero . " é igual a: " . $resultado;
}
?>