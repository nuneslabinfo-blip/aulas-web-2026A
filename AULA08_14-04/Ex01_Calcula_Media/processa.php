<?php
// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura os valores dos campos nota1 e nota2
    $n1 = $_POST['nota1'];
    $n2 = $_POST['nota2'];
    
    // Calcula a média das duas notas
    $media = ($n1 + $n2) / 2;
    
    // Exibe o resultado na tela
    echo "<h3>Resultado da Avaliação:</h3>";
    echo "A primeira nota foi: " . $n1 . "<br>";
    echo "A segunda nota foi: " . $n2 . "<br>";
    echo "<strong>A média final é: " . $media . "</strong>";
}
?>