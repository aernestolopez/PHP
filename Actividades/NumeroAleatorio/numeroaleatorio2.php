<?php
    $numeroMin = 1;
    $numeroMax = 10;
    $maxIntentos = 3;

    $numeroFijo = rand($numeroMin, $numeroMax);
    $numeroGenerado = rand($numeroMin, $numeroMax);
    $intentos = 0;
    

    while ($intentos < $maxIntentos) {
        $intentos++;

        echo "<h2>Número fijo: $numeroFijo</h2><h2>Número generado: $numeroGenerado</h2>";
        if ($numeroFijo > $numeroGenerado) {
            echo "<p>El número fijo es mayor que el número generado</p>";
            $numeroGenerado = rand($numeroGenerado+1, $numeroMax);
        } elseif ($numeroFijo < $numeroGenerado) {
            echo "<p>El número generado es mayor que el número fijo</p>";
            $numeroGenerado = rand($numeroMin, $numeroGenerado-1);
        } else {
            echo "<p>¡Enhorabuena! Ambos números son iguales.";
            break;
        }

        if ($intentos == $maxIntentos) {
            echo "<p>Intentos agotados.</p>";
        }
    }
    

?>
