<?php
// Verifica se a requisição foi feita via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura o valor enviado pelo formulário 
    $celsius = $_POST['temp_celsius'];
    //========================================

    // Aplica a fórmula: F = C * 1.8 + 32
    $fahrenheit = ($celsius * 1.8) + 32;
    //========================================
    
    // Exibe o resultado na tela 
    echo "<h3>Resultado da Conversão:</h3>";
    echo "A temperatura de " . $celsius . "°C corresponde a: ";
    echo "<strong>" . $fahrenheit . "°F</strong>";
}
?>