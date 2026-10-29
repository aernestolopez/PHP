<?php
    if(isset($_POST["calculadora"])) {
        $numero1 = $_POST['numero1'];
        $numero2 = $_POST['numero2'];
        $operacion = $_POST['operacion'];
        calcular($numero1, $numero2, $operacion);
    }

    function calcular($num1, $num2, $operacion) {
        $resultado = 0;
       
        switch($operacion) {
            case "suma":
                $resultado = $num1 + $num2;
                break;
            case "resta":
                $resultado = $num1 - $num2;
                break;
            case "multiplicacion":
                $resultado = $num1 * $num2;
                break;
            case "division":
                $resultado = $num1 / $num2;
                break;
            case "modulo":
                $resultado = $num1 % $num2;
                break;
            default:
                echo "<p>Operación no válida</p>";
                break;
        }

        $mensaje = "El resultado de la operación ". $operacion . " es: ".$resultado;
       
        echo $mensaje;
    }
?>