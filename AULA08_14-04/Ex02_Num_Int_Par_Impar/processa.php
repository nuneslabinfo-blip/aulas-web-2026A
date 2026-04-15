<?php
// Verifica se a requisição foi feita via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura o número enviado pelo formulário
    $numero = $_POST['numero_input'];
    
    // Verificação para não aceitar o número 0
    if ($numero == 0) {
        echo "<h3>Erro: O número 0 não é aceito para este teste.</h3>";
    } 
    // Se não for zero, verifica se o resto da divisão por 2 é zero para definir se é PAR 
    elseif ($numero % 2 == 0) {
        echo "<h3>O número $numero é PAR.</h3>";
    } 
    // Caso contrário, o número é ÍMPAR
    else {
        echo "<h3>O número $numero é ÍMPAR.</h3>";
    }
}
?>