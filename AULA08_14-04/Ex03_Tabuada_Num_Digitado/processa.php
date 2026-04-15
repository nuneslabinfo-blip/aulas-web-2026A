<?php
// Verifica se os dados foram enviados via formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura o número enviado pelo usuário
    $numero = $_POST['num_tabuada'];
    
    echo "<h3>Tabuada do número $numero:</h3>";
    
    // Inicia o laço de 1 até 10 para calcular a tabuada 
    for ($i = 1; $i <= 10; $i++) {
        $resultado = $numero * $i;
        // Exibe cada linha do cálculo com uma quebra de linha
        echo "$numero x $i = $resultado <br>";
    }
}
?>